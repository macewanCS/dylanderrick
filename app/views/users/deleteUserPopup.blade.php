@extends('layout/popupbox')

@section('popupTitleText')
    Delete User Account?
@stop

@section('popupContent')
	{{ HTML::style('css/deleteUserPopup.css'); }}
    {{ Form::open(array( 'route' => 'users.destroy',
            'id' => 'form-userdeletion',
            'method' => 'DELETE'
            ))
    }}

    <p class="delMessage"> 
        Are you sure you wish to delete your account? Once deleted
        there is no way to restore your data.
    </p>


    {{ Form::submit('Delete') }}
    {{ Form::button('Cancel', array( 'id' => 'lightBoxCloseBtn' )) }}


    {{ Form::close() }}
@stop
