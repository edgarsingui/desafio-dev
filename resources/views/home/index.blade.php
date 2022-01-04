@extends('layout')
@section('css')
<link href="{{asset('plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/dt-global_style.css')}}">
@endsection
@section('content')
<div class="col-lg-10">
                    <div class="row layout-top-spacing">
                        <div id="fuSingleFile" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-content widget-content-area">
                                    <div class="custom-file-container" data-upload-id="myFile">
                                        <label>Carregue o seu CNAB <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Apagar">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" @change="send" id="cnab" class="custom-file-container__custom-file__custom-file-input" accept=".txt">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <table class="moves table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Loja</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="loja in total_loja">
                                        <td>@{{loja.loja}}</td>
                                        <td><button @click="porNome(loja.loja)" data-toggle="modal" data-target="#modal" class="btn btn-outline-primary btn-sm">Visualizar</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Movimentos da Loja</h5>
                                </div>
                                <div class="modal-body">
                                   <div class="widget-content widget-content-area br-6">
                                        <table class="moves-store table table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tipo</th>
                                                    <th>Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <p class="modal-text">Saldo : @{{saldo_store.emconta}} </p>
                                                <tr v-for="movimentos in moves_store">
                                                    <td>
                                                        <div v-if="movimentos.sinal =='+'" class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="High"></div>
                                                        <div v-else class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="High"></div>
                                                    </td>
                                                    <td>@{{movimentos.tipo}}</td>
                                                    <td>@{{movimentos.valor}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary btn-block" data-dismiss="modal"><i class="flaticon-cancel-12"></i> OK</button>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <table class="moves table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                        <th>Hora</th>
                                        <th>Loja</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="movimentos in moves">
                                        <td>@{{movimentos.id}}</td>
                                        <td>@{{movimentos.tipo}}</td>
                                        <td>@{{movimentos.valor}}</td>
                                        <td>@{{movimentos.data}}</td>
                                        <td>@{{movimentos.hora}}</td>
                                        <td>@{{movimentos.loja}}</td>
                                        <td>
                                            <div v-if="movimentos.sinal =='+'" class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="High"></div>
                                            <div v-else class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="High"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

</div>
@endsection
@section('js')
<script src="{{asset('plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
<script type="module" src="{{asset('scripts/index.js')}}"></script>
<script>
        var firstUpload = new FileUploadWithPreview('myFile');
</script>    
<script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script src="{{asset('plugins/sweetalerts/custom-sweetalert.js')}}"></script>
<script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
@endsection