@extends('dashboard::base')

@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
            <div class="row">           
                <h3 class="box-title col-md-9">Request</h3>  
                <div class="col-md-3">
                <div class="pull-right btn btn-success js-add">
                       <i class="glyphicon glyphicon-plus-sign"></i> 
                </div>
                </div>           
            </div>      
            </div>        
            <!-- /.box-header -->
            <div class="box-body">
                <form> 
                    <div class="js-copy-dest">

                    </div>                   
                </form>
                        
            </div>
        <div class="box-footer">

                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
        </div>
        <!-- /.box -->
    </div>
<div class="hidden js-src">
    <div class="js-copy-item form-horizontal row form-group">                            
        <div class="col-md-3">                       
            <input type="text" class="form-control" placeholder="Имя поля (латиница)" name="name">                        
        </div> 
        <div class="col-md-3">                       
            <input type="text" class="form-control" placeholder="Тип данных в поле" name="type">                          
        </div>  
        <div class="col-md-3">                           
            <input type="text" class="form-control" placeholder="Правила валидации" name="rule">                          
        </div> 
        <div class="col-md-3">         
            <div class="pull-right  btn btn-danger js-remove">
              <i class="glyphicon glyphicon-remove-circle"></i>
            </div>                     
        </div>                                                     
    </div>
</div>

@endsection