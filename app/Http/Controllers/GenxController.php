<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class GenxController extends Controller
{
    public function authentication()
    {
        return view ('authentication');
    }

    public function dashboard()
    {
        return view ('dashboard');
    }

    public function check_authentication(Request $req)
    {
        $req->validate(
            [
                'username' => 'required',
                'password'=> 'required|min:3|max:20'
            ]
            );

        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '1234567891011121';
        $encryption_key = "W3docs";

        $uname = $req['username'];
        $upass = openssl_encrypt($req['password'], $ciphering, $encryption_key, $options, $encryption_iv);

        $check = Login::where([
            'username' => "$uname",
            'password' => "$upass",
            'active' => "1"
        ])->first();

        if ($check)
        {
            session(['fullname'=>$check['fullname']]);
            session(['username'=>$check['username']]);
            session(['level'=>$check['level']]);
            session(['avatar'=>$check['photo']]);

            return view ('dashboard');
        }
        else
        {
            return back()->with('fail', "Invalid Credentials");

        }
    }

    public function logout()
    {
        session()->forget('username');
        return view ('authentication');

    }

    public function usermaster()
    {
        $allusers = Login::get();

        $data = compact('allusers');
        return view ('usermaster')->with($data);
    }

    public function saveadduser(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required|min:5|max:50',
                'username'=> 'required|min:3|max:10',
                'password'=>'required|min:3|max:20|confirmed',
                'password_confirmation'=>'required',
                'phone' => 'required|min:10|max:10',
                'email' => 'required|email',
                'level' => 'required'
            ]
            );

        $uname = $request['username'];
        $check = Login::where([
            'username' => "$uname"
        ])->first();

        if ($check)
        {
            return back()->with('fail', 'Username Already Exist');
        }
        else
        {
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $encryption_iv = '1234567891011121';
            $encryption_key = "W3docs";

            $login = new Login;
            $login->fullname = $request['fullname'];
            $login->username = $request['username'];
            $login->password = openssl_encrypt($request['password'], $ciphering, $encryption_key, $options, $encryption_iv);
            $login->contact = $request['phone'];
            $login->email = $request['email'];

            $login->level = $request['level'];
            if ($request['photo'])
            {
                $filename = $request['username'] . "." . $request->file('photo')->getClientOriginalExtension();
                // $status = $request->file('photo')->storeAs('/public/userprofilepics',$filename);
                $request->photo->move(public_path('userprofilepics'), $filename);
                $login->photo = "1";
            }
            else
                $login->photo = "0";
            $login->save();

            return redirect('usermaster')->with('message', 'Your Record has been Successfully Added');
            die();
        }
    }

    public function adduser()
    {
        return view ('usermaster-adduser');

    }

    public function changeactive($id)
    {
        $find = Login::find($id);
        if ($find->active == 0)
            $find->active = 1;
        else
            $find->active = 0;
        $find->save();
        return redirect('usermaster');
        die();
    }

    public function edituser($id)
    {
        $data = Login::find($id);

        $takeaway = compact('data');
        return view ('usermaster-edituser')->with($takeaway);
        die();
    }

    public function saveedituser($id, Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required|min:5|max:50',
                'password'=>'required|min:3|max:20|confirmed',
                'password_confirmation'=>'required',
                'phone' => 'required|min:10|max:10',
                'email' => 'required|email',
                'level' => 'required'
            ]
            );

            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $encryption_iv = '1234567891011121';
            $encryption_key = "W3docs";

            $data = Login::find($id);
            $data->fullname = $request['fullname'];
            $data->password = openssl_encrypt($request['password'], $ciphering, $encryption_key, $options, $encryption_iv);
            $data->contact = $request['phone'];
            $data->email = $request['email'];
            $data->level = $request['level'];
            if ($request['photo'])
            {
                $filename = $request['username'] . "." . $request->file('photo')->getClientOriginalExtension();
                $request->photo->move(public_path('userprofilepics'), $filename);
                $data->photo = "1";
            }
            $data->save();
            return redirect('usermaster')->with('message', 'Your Record has been Successfully Edited');
            die();
    }

    public function deleteuser($id)
    {
        $data = Login::find($id);

        $takeaway = compact('data');
        return view ('usermaster-deleteuser')->with($takeaway);
        die();
    }

    public function confirmdeleteuser($id)
    {
        $data = Login::find($id);
        $data->delete();
        return redirect('usermaster')->with('message', 'Record Successfully Deleted');
        die();
    }

    public function sendpassword($id)
    {
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $decryption_iv = '1234567891011121';
        $decryption_key = "W3docs";

        $data = Login::find($id);
        $email = $data->email;
        $username = $data->username;
        $password = openssl_decrypt($data->password, $ciphering, $decryption_key, $options, $decryption_iv);

        $subject = "Credentials From MAS Group";

        $message = "<b> Credentials Details .... </b><br><br>";
	    $message .= "<table border=0 width=50%>";
        $message .= "<tr> <td width=25%> Username </td> <td> : ". $username ."</td> </tr>";
	    $message .= "<tr> <td> Password </td> 	<td> : ". $password ."</td> </tr> </table>";

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'Reply-To: noreply@masgroup.co.ke' . "\r\n";
        $headers .= 'From: noreply@masgroup.co.ke' . "\r\n";

        @mail($email, $subject, $message, $headers);

        return redirect('usermaster')->with('message', 'Your Password has been sent to in your Email');
        die();
    }
}
