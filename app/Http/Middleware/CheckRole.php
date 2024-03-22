<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    // 下記はリクエストが来た時に最初に呼び出される箇所で、
    // ミドルウェアは、リクエストとレスポンスの間で処理を行う仕組みのことで、
    // アプリケーションの特定の機能やセキュリティのチェックを実行するために使用され、
    // 「handle()」メソッドは、リクエストを受け取り、それに対する処理を行う役割を果たす。
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            if (in_array($role, ['premium'])) {
                return $next($request);
            } else {
                // 有料会員以外はトップページへリダイレクト
                return redirect('/');
            }
        } else {
            // 上記以外はトップページへリダイレクト
            return redirect('/');
        }
    }

    // Q：なぜ、新しいミドルウェアを作成した後、カーネルに定義する必要があるのか？
    // A：まず、「カーネル」はアプリケーションのエントリーポイントで、リクエストが到着した際に最初に呼び出される場所でもある。
    // 「ミドルウェア」はアプリケーション全体で再利用できるコンポーネントのため、
    // 新しいミドルウェアを定義することで、特定のロジックを切り出して再利用できる。
    // そのため、「カーネル」に「ミドルウェア」を追加定義することで、アプリケーション全体で共通の処理を適用できる。
    // また、リクエストが処理される前に共通の処理を実行できるため、ミドルウェアの実行順序も制御できる。※ミドルウェアは登録された順序順で実行される。
    // よって、有料会員だけが使える機能を実装するために、新しいミドルウェアを定義し、それをカーネルに追加することで、適切な順序で処理を行えるため、
    // 新しいミドルウェアを作成した後、カーネルに定義する必要がある。特にこの手順は認証や権限チェック、役割別のアクセス制御などに使われる。
}
