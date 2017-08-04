@extends('dashboard::base') @section('content')
    <div class="col-xs-12 media">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Изображения</h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-danger btn-sm js-delete-selected"><span class="fa fa-remove"> </span> Удалить выбранные</button>
                    <button type="button" class="btn btn-primary btn-sm js-media-checkAll"><span class="fa fa-check-square-o"> </span> Выбрать все</button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered dataTable js_data_table" role="grid" data-page-length='3'>
                    <thead>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger "><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger "><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                        <td class="media-item">
                            <div class="media-item-btns">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary js-media-select"><i
                                                class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="media-item-img">
                                <img class="img-responsive" src="http://placehold.it/500x500" alt="Photo">
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <form action="/media/test" class="form js-file-init">
                    <div class="form-group">
                        <label for="exampleInputFile">Выберите файлы</label>
                        <input type="file" id="exampleInputFile" class="js-input-preview" multiple="true">
                        <div class="media-preview">
                        <ul class="media-preview-l">
                        </ul>
                    </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
        <!-- /.box -->
    </div>
@endsection
