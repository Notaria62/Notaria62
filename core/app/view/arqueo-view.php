
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Arqueo diario</h4>
            </div>
            <div class="card-content table-responsive">
                <form class="form-horizontal" role="form" name="arqueoform">
                    <input type="hidden" name="view" value="arqueo">
                    <div class="col-md-6">
                        <h5>Monedas</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Denominación</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>50</td>
                                    <td><input type="text" id="coin50" name="coin50" placeholder="Monedas de 50" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicacoin(50,this.value)"></td>
                                    <td><input type="text" name="totalcoin50" id="totalcoin50" class="form-control" disabled></td>
                                </tr>
                                <tr class="success">
                                    <td>100</td>
                                    <td><input type="text" id="coin100" name="coin100" placeholder="Monedas de 100" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicacoin(100,this.value)"></td>
                                    <td><input type="text" name="totalcoin100" id="totalcoin100" class="form-control" disabled></td>
                                </tr>
                                <tr class="danger">
                                    <td>200</td>
                                    <td><input type="text" id="coin200" name="coin200" placeholder="Monedas de 200" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicacoin(200,this.value)"></td>
                                    <td><input type="text" name="totalcoin200" id="totalcoin200" class="form-control" disabled></td>
                                </tr>
                                <tr class="info">
                                    <td>500</td>
                                    <td><input type="text" id="coin500" name="coin500" placeholder="Monedas de 500" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicacoin(500,this.value)"></td>
                                    <td><input type="text" name="totalcoin500" id="totalcoin500" class="form-control" disabled></td>
                                </tr>
                                <tr class="warning">
                                    <td>1000</td>
                                    <td><input type="text" id="coin1000" name="1000" placeholder="Monedas de 1000" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicacoin(1000,this.value)"></td>
                                    <td><input type="text" name="totalcoin1000" id="totalcoin1000" class="form-control" disabled></td>
                                </tr>
                                <tr class="active">
                                    <td>Total pesos en monedas</td>
                                    <td></td>
                                    <td><input type="text" name="totalcoins" id="totalcoins" class="form-control" disabled></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Billetes</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Denominación</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1000</td>
                                    <td><input type="text" id="papermoney1000" name="papermoney1000" placeholder="Billetes de 1000" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicapapermoney(1000,this.value)"></td>
                                    <td><input type="text" name="totalpapermoney1000" id="totalpapermoney1000" class="form-control" disabled></td>
                                </tr>
                                <tr class="success">
                                    <td>2000</td>
                                    <td><input type="text" id="papermoney2000" name="papermoney2000" placeholder="Billetes de 2000" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicapapermoney(2000,this.value)"></td>
                                    <td><input type="text" name="totalpapermoney2000" id="totalpapermoney2000" class="form-control" disabled></td>
                                </tr>
                                <tr class="danger">
                                    <td>5000</td>
                                    <td><input type="text" id="papermoney5000" name="papermoney5000" placeholder="Billetes de 5000" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicapapermoney(5000,this.value)"></td>
                                    <td><input type="text" name="totalpapermoney5000" id="totalpapermoney5000" class="form-control" disabled></td>
                                </tr>
                                <tr class="info">
                                    <td>10000</td>
                                    <td><input type="text" id="papermoney10000" name="papermoney10000" placeholder="Billetes de 10000" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicapapermoney(10000,this.value)"></td>
                                    <td><input type="text" name="totalpapermoney10000" id="totalpapermoney10000" class="form-control" disabled></td>
                                </tr>
                                <tr class="warning">
                                    <td>20000</td>
                                    <td><input type="text" id="papermoney20000" name="papermoney20000" placeholder="Billetes de 20000" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicapapermoney(20000,this.value)"></td>
                                    <td><input type="text" name="totalpapermoney20000" id="totalpapermoney20000" class="form-control" disabled></td>
                                </tr>
                                <tr class="info">
                                    <td>50000</td>
                                    <td><input type="text" id="papermoney50000" name="papermoney50000" placeholder="Billetes de 50000" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicapapermoney(50000,this.value)"></td>
                                    <td><input type="text" name="totalpapermoney50000" id="totalpapermoney50000" class="form-control" disabled></td>
                                </tr>
                                <tr class="danger">
                                    <td>100000</td>
                                    <td><input type="text" id="papermoney100000" name="papermoney100000" placeholder="Billetes de 100000" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="multiplicapapermoney(100000,this.value)"></td>
                                    <td><input type="text" name="totalpapermoney100000" id="totalpapermoney100000" class="form-control" disabled></td>
                                </tr>
                                <tr class="active">
                                    <td>Total pesos en billetes</td>
                                    <td></td>
                                    <td><input type="text" name="totalpapermoneys" id="totalpapermoneys" class="form-control" disabled></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Total pesos</th>
                                    <th>Monto de cuadre signo</th>
                                    <th>Diferencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="success">
                                    <td><input type="text" name="totalmoney" id="totalmoney" class="form-control" disabled></td>
                                    <td><input type="text" id="totalcuadresigno" name="totalcuadresigno" placeholder="Monto cuadre en signo" class="form-control" onkeypress="return justNumbers(event);" onKeyUp="restadiferencia(this.value)"></td>
                                    <td><input type="text" name="totaldifference" id="totaldifference" class="form-control" disabled></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary btn-block">Calcular</button>
                        <button class="btn btn-primary btn-block">Generar impresión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function justNumbers(e) {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    }



    //Función que realiza la multiplicacion
    function multiplicacoin(valor, cant) {
        try {
            //Calculamos el número escrito:
            valor = (isNaN(parseInt(valor))) ? 0 : parseInt(valor);
            cant = (isNaN(parseInt(cant))) ? 0 : parseInt(cant);
            resultado = valor * cant;
            $("#totalcoin" + valor).val(resultado);
        }
        //Si se produce un error no hacemos nada
        catch (e) { }
        finally {

            $("#totalcoins").val(validanum($("#totalcoin50").val()) + validanum($("#totalcoin100").val()) + validanum($("#totalcoin200").val()) + validanum($("#totalcoin500").val()) + validanum($("#totalcoin1000").val()));
            $("#totalmoney").val(validanum($("#totalcoins").val()) + validanum($("#totalpapermoneys").val()));
        }
    }
    //Función que realiza la multiplicacion
    function multiplicapapermoney(valor, cant) {
        try {
            //Calculamos el número escrito:
            valor = (isNaN(parseInt(valor))) ? 0 : parseInt(valor);
            cant = (isNaN(parseInt(cant))) ? 0 : parseInt(cant);
            resultado = valor * cant;
            $("#totalpapermoney" + valor).val(resultado);
        }
        //Si se produce un error no hacemos nada
        catch (e) { }
        finally {
            $("#totalpapermoneys").val(validanum($("#totalpapermoney1000").val()) + validanum($("#totalpapermoney2000").val()) + validanum($("#totalpapermoney5000").val()) + validanum($("#totalpapermoney10000").val()) + validanum($("#totalpapermoney20000").val()) + validanum($("#totalpapermoney50000").val()) + validanum($("#totalpapermoney100000").val()));
            $("#totalmoney").val(validanum($("#totalcoins").val()) + validanum($("#totalpapermoneys").val()));
        }
    }

    //Función que realiza la multiplicacion
    function restadiferencia(valor) {
        try {
            //Calculamos el número escrito:
            //$("#totalmoney").val();
            valor = (isNaN(parseInt(valor))) ? 0 : parseInt(valor);
            totalefecty = (isNaN(parseInt($("#totalmoney").val()))) ? 0 : parseInt($("#totalmoney").val());
            resultado = totalefecty - valor;
            $("#totaldifference").val(resultado);
        }
        //Si se produce un error no hacemos nada
        catch (e) { }
        finally {

            $("#totalcoins").val(validanum($("#totalcoin50").val()) + validanum($("#totalcoin100").val()) + validanum($("#totalcoin200").val()) + validanum($("#totalcoin500").val()) + validanum($("#totalcoin1000").val()));
            $("#totalmoney").val(validanum($("#totalcoins").val()) + validanum($("#totalpapermoneys").val()));
        }
    }

    function validanum(valor) {
        try {
            //Calculamos el número escrito:
            valor = (isNaN(parseInt(valor))) ? 0 : parseInt(valor);
            return valor;

        }
        //Si se produce un error no hacemos nada
        catch (e) { }
    }

</script>
