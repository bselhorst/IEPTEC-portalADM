@extends('layout/layout')

@section('page-title')
<span class="font-weight-semibold">Pessoas</span> - Cadastrar
@endsection

@section('page-title-buttons')
@endsection

@section('breadcrumb')
<a href="../tecnologia" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="{{ route('pessoas.index') }}" class="breadcrumb-item"><i class="icon-users mr-2"></i> Pessoas</a>
<span class="breadcrumb-item active">{{ @$data ? 'Editar' : 'Cadastrar' }}</span>
@endsection

@section('content')
<script src="{{ asset('backend/assets/js/jquery.mask.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/jquery-maskmoney.js') }}" type="text/javascript"></script>
<script>
    $(function() {
        $('#salario').maskMoney();
    })
    function verificarData(){
        $dt_nomeacao = document.getElementById('data_nomeacao').value;
        $dt_exoneracao = document.getElementById('data_exoneracao').value;

        if($dt_exoneracao == ""){
            return true;
        }
        if($dt_exoneracao >= $dt_nomeacao){
            return true;
        }else{
            alert("Data final não pode ser menor do que a data inicial");
        }

        return false;
    }
</script>
<!-- Form validation -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ @$data ? 'Editar Cadastro' : 'Cadastrar Pessoa' }}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form class="form-validate-jquery" method="POST" onsubmit="return verificarData()" action="{{ @$data ? route('contratos.update', [$pessoa_id, $data->id]) : route('contratos.store', $pessoa_id) }}">
            <input type='hidden' name="pessoa_id" value="{{ $pessoa_id }}" />
            @csrf
            @if (@$data)
                @method('PATCH')
            @endif
                <legend class="text-uppercase font-size-sm font-weight-bold">Endereço</legend>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Matrícula</label>
                    <div class="col-lg-2">
                        <input type="text" name="matricula" class="form-control" placeholder="" value="{{ @$data->matricula }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Termo/Portaria</label>
                    <div class="col-lg-4">
                        <input type="text" name="termo_portaria" class="form-control" data-mask="00000" placeholder="" value="{{ @$data->termo_portaria }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Carga Horária</label>
                    <div class="col-lg-2">
                        <input type="number" name="carga_horaria" class="form-control" placeholder="" value="{{ @$data->carga_horaria }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Salário</label>
                    <div class="col-lg-2">
                        <input type="text" name="salario" id="salario" data-prefix="R$ " placeholder="R$ 0,00" data-thousands="." data-decimal="," value="{{ (@$data->salario) ? 'R$ '.number_format($data->salario, 2, ',','.') : ''  }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Data da Nomeação <span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <input type="date" name="data_nomeacao" id="data_nomeacao" class="form-control" placeholder="Complemento" value="{{ @$data->data_nomeacao }}" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label class="col-form-label col-lg-2">Data da Exoneração</label>
                    <div class="col-lg-2">
                        <input type="date" name="data_exoneracao" id="data_exoneracao" class="form-control" placeholder="Complemento" value="{{ @$data->data_exoneracao }}" autocomplete="off">
                    </div>
                </div>
            </fieldset>

            <div class="d-flex justify-content-end align-items-center">
                <button type="reset" class="btn btn-light" id="reset">Reset <i class="icon-reload-alt ml-2"></i></button>
                <button type="submit" class="btn btn-primary ml-3">{{ @$data ? 'Editar' : 'Cadastrar' }} <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>

<!-- /form validation -->
@endsection
