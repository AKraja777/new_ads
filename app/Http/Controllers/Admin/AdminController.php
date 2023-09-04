<?php// app/Http/Controllers/Admin/UserController.php

use App\Exports\VerifiedUsersExport;
use Maatwebsite\Excel\Facades\Excel;

public function exportVerifiedUsers()
{
    return Excel::download(new VerifiedUsersExport(), 'verified_users.xlsx');
}
