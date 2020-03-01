@extends('masterlayouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="content">
                <form action="{{route('ContestCategory.store')}}" method="post">
                    {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control" name="contest_name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control datepicker" name="registration_start_date">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control datepicker" name="registration_end_date">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control datepicker" name="contest_date">
                </div>
                <button class="btn btn-primary" type="submit">Save</button>

                </form>

            </div>

        </div>

    </div>
    @stop