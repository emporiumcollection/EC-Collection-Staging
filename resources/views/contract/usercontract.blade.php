@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
        </div>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
            <li class="active">{{ $pageTitle }}</li>
        </ul>	  

    </div>


    <div class="page-content-wrapper m-t">	 	

        <div class="sbox animated fadeInRight">
            <div class="sbox-content">
                <div class="panel-group" id="uc-accordion">
                    <?php
                    if(!empty($rowData)) {
                        $sn = 1;
                        foreach ($rowData as $row) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#uc-accordion" href="#uc-collapse-<?php echo $sn; ?>"><?php echo $row->title; ?></a>
                                    </h4>
                                </div>
                                <div id="uc-collapse-<?php echo $sn; ?>" class="panel-collapse collapse <?php echo ($sn == 1)? 'in' : ''; ?>">
                                    <div class="panel-body"><?php echo nl2br($row->description); ?></div>
                                </div>
                            </div>
                            <?php
                            $sn++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>	
    </div>	  
</div>	
<script>
    $(document).ready(function () {

        $('.do-quick-search').click(function () {
            $('#SximoTable').attr('action', '{{ URL::to("contract/multisearch")}}');
            $('#SximoTable').submit();
        });

    });
</script>		
@stop