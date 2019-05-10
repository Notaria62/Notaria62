<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Extn.</th>
            <th>Start date</th>
            <th>Salary</th>
            <th>Extn.</th>
            <th>Start date</th>
            <th>Salary</th>
            <th>Salary</th>
            <th>Extn.</th>
            <th>Extn.</th>
            <th>Start date</th>
            <th>Salary</th>
            <th>Extn.</th>
            <th>Start date</th>
            <th>Salary</th>
            <th>Salary</th>
            <th>Salary</th>
        </tr>
    </thead>

</table>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "ajax": '/core/app/view/test2.txt'
    });
});
</script>