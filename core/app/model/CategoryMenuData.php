<?php


/**
* @author DigitalesWeb
* @website http://digitalesweb.com/
**/

class CategoryMenuData
{
    public static $tablename = "categorymenu";


    public function __construct()
    {
        $this->name = "";
        $this->icon = "";
        $this->url = "";
        $this->category_id = "";
        $this->created_at = Util::getDatetimeNow();
    }

    public static function get_base_categories()
    {
        $sql = "select * from ".self::$tablename." where category_id is NULL ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CategoryMenuData());
    }

    public static function get_cat_by_id($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new CategoryMenuData());
    }

    public static function edit_btn($id)
    {
        return '<a href="./?view=admineditcategorymenu&id='.$id.'" data-toggle="tooltip" title="Editar" class="btn btn-link btn-success btn-just-icon btn-sm"><i class="material-icons">edit</i> </a>';
    }

    public static function del_btn($id)
    {
        return '<a href="./?view=admindelcategorymenu&id='.$id.'" data-toggle="tooltip" title="Eliminar" class="btn btn-link btn-danger btn-just-icon btn-sm"> <i class="material-icons">delete</i></a>';
    }

    public static function get_cats_by_cat_id($id)
    {
        $sql = "select * from ".self::$tablename." where category_id=$id";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CategoryMenuData());
    }

    public static function list_tree_cat_id($id)
    {
        $subs = self::get_cats_by_cat_id($id);
        if (count($subs)>0) {
            echo "<ul>";
            foreach ($subs as $s) {
                $html='<li class=""> ';
                $html.='<p><a href="'.$s->url.'"> ';
                $html.='<i class="material-icons">'.$s->icon.'</i>'.$s->name.' </a>';
                $html.= self::addHTMLUserGroupCategoryMenu($s->id).self::edit_btn($s->id).' '.self::del_btn($s->id).' </p></li>';
                echo $html;
                self::list_tree_cat_id($s->id);
            }
            echo "</ul>";
        }
    }
    public static function addHTMLUserGroupCategoryMenu($id)
    {
        $pcats = CategoryMenuData::get_usergroups_categorias($id);
        $html="";
        if (count($pcats)>0) {
            foreach ($pcats as $pc) {
                $c = UserGroupsData::getById($pc->user_groups_id);
                $html.= "<span class='badge badge-secondary'>";
                $html.= $c->group_name;
                $html.= "</span>";
            }
        }
        return $html;
    }

    public static function isUserGroupCategoryMenu($id, $user_level)
    {
        // echo $user_level;
        $ug_catmenu = CategoryMenuData::get_usergroups_categorias($id);
        $ug = UserGroupsData::getAll();
        $idTrue = 0;
        if (count($ug)>0) {
            foreach ($ug as $d) {
                $encontrado = false;
                foreach ($ug_catmenu as $pc) {
                    if ($pc->user_groups_id==$d->id && $pc->user_groups_id==$user_level) {
                        $encontrado = true;
                        break;
                    }
                }
                if ($encontrado) {
                    $flag =true;
                    //echo ' id:'.$d->id.' ';
                    $idTrue = $d->id;
                }
            }
        }
        return $idTrue;
    }
    public static function list_tree_cat_id_user($id)
    {
        $user = Util::current_user();
        $subs = self::get_cats_by_cat_id($id);
        if (count($subs)>0) {
            $html="";
            echo "<div class=\"collapse\" id=\"$id\"><ul class=\"nav\">";
            foreach ($subs as $s) {
                $view_id = CategoryMenuData::isUserGroupCategoryMenu($s->id, $user->user_level);
                if ($user->user_level==$view_id) {
                    $html='<li class="nav-item"> ';
                    $html.='<a class="nav-link" href="'.$s->url.'"> ';
                    $html.='<span class="sidebar-mini"> <i class="material-icons">'.$s->icon.'</i></span><span class="sidebar-normal">'.$s->name.'</span> ';
                    $html.='</a> </li>';
                    echo $html;
                    self::list_tree_cat_id_user($s->id);
                }
            }
            echo "</ul></div>";
        }
    }

    public static function select_tree_cat_id($id, $level)
    {
        $subs = self::get_cats_by_cat_id($id);
        if (count($subs)>0) {
            foreach ($subs as $s) {
                echo "<option value=\"$s->id\" > ".str_repeat("-", $level)."$s->name </option>";
                self::select_tree_cat_id($s->id, $level+1);
            }
        }
    }
    public function selected_tree_cat_id($id, $level, $curr_id, $selected_id)
    {
        $subs = self::get_cats_by_cat_id($id);
        if (count($subs)>0) {
            foreach ($subs as $s) {
                if ($s->id!=$curr_id) {
                    $selected = "";
                    if ($s->id==$selected_id) {
                        $selected= "selected";
                    }
                    echo "<option value=\"$s->id\" $selected>".str_repeat("-", $level)."$s->name </option>";
                    self::selected_tree_cat_id($s->id, $level+1, $curr_id, $selected_id);
                }
            }
        }
    }

    public function add()
    {
        $sql = "insert into ".self::$tablename." (name, icon, url, category_id) ";
        $sql .= "value (\"$this->name\",\"$this->icon\",\"$this->url\",$this->category_id) ";
        return Executor::doit($sql);
    }
    public function addUserGroupsCategoryMenu($ug_id, $last_id)
    {
        $sql= "insert into user_groups_categorymenu (user_groups_id,category_id) ";
        $sql .= "value ($ug_id,$last_id) ";
        return Executor::doit($sql);
    }

    public static function delById($id)
    {
        $sql = "delete from ".self::$tablename." where id=$id";
        Executor::doit($sql);
    }
    public static function delById_usergroups_categorias($id)
    {
        $sql = "delete from user_groups_categorymenu where category_id=$id";
        Executor::doit($sql);
    }
    public function del()
    {
        $sql = "delete from ".self::$tablename." where id=$this->id";

        Executor::doit($sql);
    }

    public function update()
    {
        $sql = "update ".self::$tablename." set name=\"$this->name\", icon=\"$this->icon\" , url=\"$this->url\" ,
    category_id=$this->category_id where id=$this->id";

        Executor::doit($sql);
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new CategoryMenuData());
    }

    public static function getAll()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new CategoryMenuData());
    }
    public static function get_usergroups_categorias($id)
    {
        $sql = "select * from user_groups_categorymenu where category_id=".$id;
        $query = Executor::doit($sql);
        return Model::many($query[0], new CategoryMenuData());
    }

    public static function getLastId()
    {
        $sql = "select * from ".self::$tablename ." ORDER BY id DESC LIMIT 1 ";
        $query = Executor::doit($sql);
        return Model::one($query[0], new CategoryMenuData());
    }

    public static function getLike($q)
    {
        $sql = "select * from ".self::$tablename." where name like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CategoryMenuData());
    }
}