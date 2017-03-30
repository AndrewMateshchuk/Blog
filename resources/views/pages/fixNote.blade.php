@extends('pages.notation')
@section('title')
    {!!  $note->title !!}
@stop
@section('note')
    {!!  $note->text !!}
@stop
@section('deleteBtn')
    <img id="deleteNoteBtn" onclick="deleteNote()" src="http://download.seaicons.com/icons/custom-icon-design/flatastic-10/512/Delete-file-icon.png"  height="24" width="24" title="Delete note">
@stop

