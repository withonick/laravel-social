@extends('layouts.messenger')

@section('title', 'Messenger')

@section('content')

    <div class="col-sm-8 conversation">
        <div class="row heading">
            <div class="col-sm-8 col-xs-7 heading-name">
            </div>
            <div class="col-sm-1 col-xs-1  heading-dot pull-right">
                <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
            </div>
        </div>

        <div class="row message" id="conversation">

        </div>

        <div class="row reply">
            <div class="col-sm-10 col-xs-9 reply-main">
                <textarea class="form-control" rows="1" name="message_text" id="comment"></textarea>
            </div>
            <div class="col-sm-1 reply-send" >
                <i class="fa-solid fa-image" style="font-size: 20px" id="img_btn"></i>
                <input type="file" name="message_img" style="display: none" id="img_input">
            </div>
            <div class="col-sm-1 reply-send">
                <i class="fa-sharp fa-solid fa-paper-plane" id="message_submit" style="font-size: 20px"></i>
            </div>
        </div>
    </div>

@endsection
