

@extends('admin.master')

@section('conteudo')
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Empty Page </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    General </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Empty Page </a>
            </div>
        </div>

    </div>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-archive"></i>
                        </div>
                        <span class="more">Histórico de Guias (Seguro)</span>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-book"></i>
                        </div>
                        <a class="more" href="javascript:;"> Histórico de Guias (Plano)
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-check"></i>
                        </div>
                        <a class="more" href="javascript:;"> Central de Aprovação
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <a class="more" href="javascript:;">Central Medicina Ocupacional
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-bullhorn"></i>
                        </div>
                        <a class="more" href="javascript:;"> Call Center - Beneficiário
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-money-bill-alt"></i>
                        </div>
                        <a class="more" href="javascript:;"> Realizar Recarga Leve+
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
