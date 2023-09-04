<?Php
use Illuminate\Http\Request;
use App\Models\Withdrawal; // Import the Withdrawal model

class WithdrawalController extends Controller
{
    // ... Other methods ...

    public function updateStatus(Request $request)
    {
        $status = $request->input('status');
        $withdrawalIds = $request->input('withdrawal_ids'); // Make sure this matches the field name in your JavaScript

        foreach ($withdrawalIds as $withdrawalId) {
            $withdrawal = Withdrawal::find($withdrawalId);
            if ($withdrawal) {
                $withdrawal->status = $status;
                $withdrawal->save();
            }
        }

        return response()->json(['success' => true]);
    }
}
