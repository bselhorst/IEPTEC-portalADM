@extends('layout.layout')

@section('page-title')
<span class="font-weight-semibold">Almoxarifado</span>
@endsection

@section('page-title-buttons')
<!--<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>-->
@endsection

@section('breadcrumb')
<a href="tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{route('almoxarifado.index')}}" class="breadcrumb-item"><i class="icon-price-tags2 mr-2"></i> Almoxarifado</a>
<a href="#" class="breadcrumb-item active"><i class="icon-box-remove mr-2"></i> Retirar Itens</a>
@endsection

@section('content')
    <!-- Form validation -->
    <script>
        function delItem(key, text, r){
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("tabLista").deleteRow(i);
            var sel = document.getElementById('unidade_id');
            sel.options[sel.options.length] = new Option(text, key);
            var el = document.getElementById(key);
            el.remove();
        }
        function addItem(){
            var unidade = document.getElementById('unidade_id');
            if(unidade.value != ''){
                //document.getElementById('List').innerHTML += "<p id='"+unidade.value+"'><input type='hidden' name='lista[]' value='"+unidade.value+"' />"+unidade.options[unidade.selectedIndex].text+"<a id='myLink' title='Click to do something' class='dropdown-item justify-content-center' href='#' onclick='delItem("+unidade.value+","+JSON.stringify(unidade.options[unidade.selectedIndex].text)+");return false;'><i class='icon-trash text-danger'></i> Deletar Item</a><br></p>";
                var saldo = unidade.options[unidade.selectedIndex].text.split('[').pop().split(']')[0];
                //alert($saldo);
                var table = document.getElementById("tabLista");
                var row = table.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                cell1.innerHTML = unidade.options[unidade.selectedIndex].text+"<input type='hidden' name='unidade[]' id='lista' class='form-control' placeholder='Quantidade' value='"+unidade.value+"'>";
                cell2.innerHTML = "<input type='number' name='quantidade[]' class='form-control' placeholder='Quantidade' max="+saldo+" required>";
                cell3.innerHTML = "<a id='myLink' title='Click to do something' class='dropdown-item justify-content-center' href='#' onclick='delItem("+unidade.value+","+JSON.stringify(unidade.options[unidade.selectedIndex].text)+",this);return false;'><i class='icon-trash text-danger'></i>Deletar</a>";
                var sel = document.getElementById('unidade_id');
                sel.remove(document.getElementById('unidade_id').selectedIndex);
            }else{
                alert("Selecione um item");
            }
        }

        function funcSubmit(){
            if(document.getElementById('lista')){
                return true;
            }else{
                alert("Lista vazia, por favor adicione os itens");
                return false;
            }
        }

        $('#addItem').click(function(){ addItem(); return false; });
    </script>
    <div class="card">
        <div class="card-body">
            <form class="form-validate-jquery" id="form1" method="POST" onsubmit="return funcSubmit()" action="{{ route('almoxarifado.confirmRetirar') }}">
                @csrf
                <fieldset class="mb-3" id="fieldset">
                    <div id="divItem">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Lista de Retirada de Itens</legend>
                        <div class="form-group row" id="totalItems">
                            <div class="col-lg-3"></div>
                            <label class="col-form-label col-lg-1">Item <span class="text-danger">*</span></label>
                            <div class="col-lg-5">
                                <select class="form-control select-search select2-hidden-accessible" name="unidade_id" id="unidade_id" tabindex="-1" aria-hidden="true">
                                    @if (count($data) == 0)
                                        <option value="">Sem Itens</option>
                                    @else
                                    <option value="">Selecione um item para adicionar na lista</option>
                                    @endif
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}">[{{ $item->saldo }}] {{ $item->descricao }} ({{ $item->unidade }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <a id="myLink" title="Click to do something" class="dropdown-item justify-content-center"
                            href="#" onclick="addItem();return false;"><i class="icon-add text-success"></i> Adicionar item na lista</a>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <table class="table table-bordered table-lg col-lg-6 responsible" id="tabLista">
							<tbody>
								<tr class="table-border-double table-active">
									<th colspan="3">Lista</th>
                                </tr>
                                <tr>
									<th colspan="3">[Quantidade] Item (Unidade)</th>
								</tr>
							</tbody>
						</table>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3"></div>
                        <label class="col-form-label col-lg-1">Solicitante<span class="text-danger"></span></label>
                        <div class="col-lg-5">
                            <input type="text" name="solicitante" class="form-control" placeholder="Descrição ou Código" required>
                            <input type="hidden" name="usuario" class="form-control" value="{{Auth::user()->name}}">
                        </div>
                    </div>
                </fieldset>
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary ml-3">Confirmar Lista<i class="icon-down ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>


@endsection
