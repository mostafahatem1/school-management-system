@extends('layouts.master')

@section('css')
@section('title')
    {{ trans('grades_trans.title_page') }}
@stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('main_trans.grades')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-statistics h-100">
                <div class="card-body">
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('grades_trans.add_Grade') }}
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('grades_trans.Name')}}</th>
                                <th>{{__('grades_trans.Notes')}}</th>
                                <th>{{__('grades_trans.Processes')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                                <?php $i=0 ?>
                                @foreach($grades as $grade)
                                        <?php $i++ ?>
                                 <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$grade->Name}}</td>
                                    <td>{{$grade->Notes}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $grade->id }}"
                                                title="{{ trans('grades_trans.Edit') }}"><i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $grade->id }}"
                                                title="{{ trans('grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                 </tr>
                                        <!-- edit_modal_Grade -->
                                        <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                            id="exampleModalLabel">
                                                            {{ trans('grades_trans.edit_Grade') }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- add_form -->
                                                        <form action="{{ route('grades.update', 'test') }}" method="post">
                                                            {{ method_field('patch') }}
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="Name"
                                                                           class="mr-sm-2">{{ trans('grades_trans.stage_name_ar') }}
                                                                        :</label>
                                                                    <input id="Name" type="text" name="Name"
                                                                           class="form-control"
                                                                           value="{{ $grade->getTranslation('Name', 'ar') }}"
                                                                           required>
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                           value="{{ $grade->id }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="Name_en"
                                                                           class="mr-sm-2">{{ trans('grades_trans.stage_name_en') }}
                                                                        :</label>
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $grade->getTranslation('Name', 'en') }}"
                                                                           name="Name_en" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleFormControlTextarea1">{{ trans('grades_trans.Notes') }}
                                                                    :</label>
                                                                <textarea class="form-control" name="Notes"
                                                                          id="exampleFormControlTextarea1"
                                                                          rows="3">{{ $grade->Notes }}</textarea>
                                                            </div>
                                                            <br><br>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                                                                <button type="submit"
                                                                        class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- delete_modal_Grade -->
                                        <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                            id="exampleModalLabel">
                                                            {{ trans('grades_trans.delete_Grade') }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('grades.destroy', 'test') }}" method="post">
                                                            {{ method_field('Delete') }}
                                                            @csrf
                                                            {{ trans('grades_trans.Warning_Grade') }}
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{ $grade->id }}">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">{{ trans('grades_trans.submit') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('grades_trans.add_Grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('grades.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('grades_trans.stage_name_ar') }}
                                        :</label>
                                    <input id="Name" type="text" name="Name" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="Name_en" class="mr-sm-2">{{ trans('grades_trans.stage_name_en') }}
                                        :</label>
                                    <input type="text" class="form-control" name="Name_en">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('grades_trans.Notes') }}
                                    :</label>
                                <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                                          rows="3"></textarea>
                            </div>
                            <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
