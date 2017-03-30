<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/chat/update',
        '/chat/new',
        '/chat/load',
        '/registration',
        '/login',
        'addNotation',
        '/reUploadNotation',
        'deleteNote',
        'note/add_comment',
        'note/getComments',
        'note/downloadComments',
        'note/add_answer',
        'note/like'
    ];
}
