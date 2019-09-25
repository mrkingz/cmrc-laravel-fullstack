<?php

namespace App\Http\Traits;

use App\User;
use Illuminate\Http\Request;
use App\Http\Traits\TokenTrait;
use Illuminate\Support\Facades\Validator;

trait VerificationTrait
{
    use TokenTrait;

    /**
     * Instance of verification code
     */
    protected $vCodeInstance;

    /**
     * Get the view for the phone number verification
     * 
     * @param string $token
     * @param Illuminate\Http\Response
     */
    protected function getVerificationForm($token = null)
    { 
        // We need to get the order type from the url
        // We'll need it when redirect back if error occured
        // That will enable us show the form that was submitted
        $type = array_last(explode('/', url()->previous()));

        // We will check if url has token
        // Then check if token from url is equal to the token stored in session
        return is_null($token) || $token !== session('order.token')
                ? redirect($this->redirectPath())
                : view('pages.verification', ['type' => $type]);
    }

    /**
     * Generate a url for the verification page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showVerificationForm(Request $request, $token = null)
    {
        $data = $this->validator($request->all())->validate();

        $data['phone'] = $request->zip_code . substr($request->phone, -10);

        if ($request->hasFile('qqfile')) {
            session()->put('order.data', $data);

            if ($request->currentItem > 1) {
                session()->push(
                    'order.filenames', 
                    array_first($this->storeFilesToTempStorage($request->only('qqfile')))
                );
            } else {
                session()->put('order.filenames', 
                $this->storeFilesToTempStorage($request->only('qqfile'), true));
            }
        } else {
            $this->deleteTempStorage();
            
            session()->forget('order.filenames');
            session()->put('order.data', $data);          
        }

        $this->getVerificationCodeInstance()->createCode($request->user());
        $url = url()->previous() . '/' . session('order.token');
        
        return $request->ajax()
                ? response()->json(['success' => true, 'url' => $url])
                : redirect($url);
    }


    /**
     * Get instance of App\Http\Classes\verificationCode
     * 
     * @return App\Http\Classes\verificationCode
     */
    protected function getVerificationCodeInstance()
    {
        return $this->vCodeInstance;
    }

    /**
     * Set the verification code instance
     * 
     * @param App\Http\Classes\verificationCode $vCodeInstance
     */
    protected function setVerificationCodeInstance($vCodeInstance)
    {
        $this->vCodeInstance = $vCodeInstance;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\User $user
     * @return string
     */
    protected function updateCode(User $user)
    {
        return $this->getVerificationCodeInstance()->resetCode($user);
    }

    /**
     * Confirm verification code
     * 
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function verification($data)
    {   
        Validator::make($data, [
                'code' => 'required|digits:6'
            ])->validate();

        // If verification is successfull, response will be null
        $response =  $this->getVerificationCodeInstance()->verifyCode($data['code']);
        
        session()->forget('order.token');

        return is_null($response) 
                ?: redirect()->back()->withInput()->withErrors(['code' => $response]);
    }
}