<?php
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\User;

class VerifiedUsersExport implements FromCollection
{
    public function collection()
    {
        // Query verified users and return the collection
        return User::where('status', 1)->get(['id', 'name', 'email']);
    }
}
