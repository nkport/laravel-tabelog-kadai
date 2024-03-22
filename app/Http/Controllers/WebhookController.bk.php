

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends Controller
{
    public function handleCustomerSubscriptionUpdated(Request $request)
    {
        $payload = $request->all();

        if ($payload['type'] === 'customer.subscription.updated') {

            // $payload['data']['object']['customer']を使用して、Stripeのイベントから顧客ID（$stripeId）を取得します。
            $stripeId = $payload['data']['object']['customer'];

            //取得した顧客IDを使用して、データベースから該当するユーザーを取得します。これはUserモデルを使用しています。
            $user = User::where('stripe_id', $stripeId)->first();

            // ユーザーが見つかった場合は、そのユーザーのroleを「premium」に変更し、データベースに保存します。
            if ($user) {
                $user->role = 'premium';
                $user->save();
            }

        }

        return response()->json(['success' => true]);

        // 最後に、$this->successMethod()を呼び出して、Stripeへの応答を返します。
        // return $this->successMethod();
    }

    public function portalsubscription(Request $request)
    {
        // ユーザーのセッションを使用してStripeのポータルにリダイレクトする
        return $request->user()->redirectToBillingPortal();
    }
}
