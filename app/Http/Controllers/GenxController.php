<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Treatment;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class GenxController extends Controller
{

    // Login Authentication

    public function authentication()
    {
        return view ('authentication');
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

    // Dashboard

    public function dashboard()
    {
        return view ('dashboard');
    }

    // User


    public function usermaster()
    {
        $allusers = Login::get();

        $data = compact('allusers');
        return view ('usermaster')->with($data);
    }


    public function adduser()
    {
        return view ('usermaster-add');

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

            return redirect('usermaster')->with('message', 'Record has been Successfully Added');
            die();
        }
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
        return view ('usermaster-edit')->with($takeaway);
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
            return redirect('usermaster')->with('message', 'Record has been Successfully Edited');
            die();
    }

    public function deleteuser($id)
    {
        $data = Login::find($id);

        $takeaway = compact('data');
        return view ('usermaster-delete')->with($takeaway);
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

        return redirect('usermaster')->with('message', 'Your Password has been sent to your Email');
        die();
    }


    // Customer

    public function customermaster()
    {
        $allcustomers = Customer::get();
        $data = compact('allcustomers');
        return view ('customermaster')->with($data);
    }

    public function addcustomer()
    {
        return view ('customermaster-add');

    }

    public function saveaddcustomer(Request $request)
    {
        $age18 = date('2004/01/01');
        $startdt = date('1950/01/01');
        $request->validate(
            [
                'dob'           => 'nullable|after:'.$startdt.'|before:'.$age18,
                'fullname'      => 'required|min:5|max:50',
                'phone'         => 'nullable|min:10|max:21',
                'email'         => 'nullable|email',
                'treatment'     => 'required|min:10|max:250',
                'amount'        => 'required|integer|min:1000|max:500000',
                'discount'      => 'nullable|integer|min:100|max:100000',
                'reference'     => 'nullable|min:5|max:50',
            ]
            );

            $login              = new Customer;
            $login->cname       = $request['fullname'];
            $login->ccontact    = $request['phone'];
            $login->cemail      = $request['email'];
            $login->cdob        = $request['dob'];
            $login->ctreatment  = $request['treatment'];
            $login->camount     = $request['amount'];
            $login->cdisc       = $request['discount'];
            $login->creference  = $request['reference'];
            $login->save();

            return redirect('customers')->with('message', 'Customer Record has been Successfully Added');
            die();
    }

    public function editcustomer($id)
    {
        $data = Customer::find($id);

        $takeaway = compact('data');
        return view ('customermaster-edit')->with($takeaway);
        die();
    }

    public function saveeditcustomer($id, Request $request)
    {
        $age18 = date('2004/01/01');
        $startdt = date('1950/01/01');
        $request->validate(
            [
                'dob'           => 'nullable|after:'.$startdt.'|before:'.$age18,
                'fullname'      => 'required|min:5|max:50',
                'phone'         => 'nullable|min:10|max:21',
                'email'         => 'nullable|email',
                'treatment'     => 'required|min:10|max:250',
                'amount'        => 'required|integer|min:1000|max:500000',
                'discount'      => 'nullable|integer|min:100|max:100000',
                'reference'     => 'nullable|min:5|max:50',
            ]
            );
            $cust = Customer::find($id);
            $cust->cname       = $request['fullname'];
            $cust->ccontact    = $request['phone'];
            $cust->cemail      = $request['email'];
            $cust->cdob        = $request['dob'];
            $cust->ctreatment  = $request['treatment'];
            $cust->camount     = $request['amount'];
            $cust->cdisc       = $request['discount'];
            $cust->creference  = $request['reference'];
            $cust->save();
            return redirect('customers')->with('message', 'Customer Record has been Successfully Edited');
            die();
    }

    public function deletecustomer($id)
    {
        $data = Login::find($id);

        $takeaway = compact('data');
        return view ('usermaster-delete')->with($takeaway);
        die();
    }

    public function confirmdeletecustomer($id)
    {
        $data = Login::find($id);
        $data->delete();
        return redirect('usermaster')->with('message', 'Record Successfully Deleted');
        die();
    }


    // Payments

    public function payments()
    {
        session()->forget(['customerID']);
        session(['paymentstatus'=>'0']);
        $allpayments = null;
        $check = null;
        $allcustname = Customer::select('cname')->orderBy('cname')->get();
        $data = compact('allpayments','allcustname','check');
        return view ('payments')->with($data);
    }

    public function showpayments(Request $request)
    {
        session(['paymentstatus'=>'0']);
        $allpayments = null;
        $allcustname = Customer::select('cname')->orderBy('cname')->get();
        $check = Customer::where([
            'cname' => $request['custid']
        ])->first();

        if($check)  // If Customer Found
        {
            session(['customerID'=> $check['cid']]);
            $checkpayments = Payment::where([
                'cid' => $check['cid']
            ])->first();

            if ($checkpayments) // If there is any Payment
            {
                session(['paymentstatus'=>'2']);
                $allpayments = Payment::where(['cid' => $check['cid']])->orderBy('preceiptno')->get();
                $data = compact('allpayments','allcustname','check');
                return view ('payments')->with($data);
            }
            else        // If there is NO Payment
            {
                session(['paymentstatus'=>'1']);
                $data = compact('allpayments','allcustname','check');
                return view ('payments')->with($data);
            }
        }
        else    // If Customer Not Found
        {
            return redirect('payments')->with('message', 'Customer Not Found');
        }
    }

    public static function calculatePayment($cid)
    {
        $paymentdone = Payment::where('cid',$cid)->sum('pamount');
        return $paymentdone;
    }

    public static function NewReceiptNo()
    {
        return Payment::latest()->value('preceiptno') + 1;
    }

    public function addpayments()
    {
        $custdetails = Customer::where(['cid' => Session('customerID')])->first();
        $paymentdone = Payment::where('cid',Session('customerID'))->sum('pamount');
        $receiptNo = Payment::latest()->value('preceiptno') + 1;
        // $receiptNo = Payment::max('preceiptno')
        $staffname = Login::select('fullname')->orderBy('fullname')->get();

        $data = compact('custdetails','paymentdone','staffname');
        return view ('payments-add')->with($data);;
    }

    public function savenewpayments(Request $request)
    {
        $request->validate(
            [
                'receiptdate'   => 'required|after:yesterday|before:tomorrow',
                'amount'        => 'required_with:balance|integer|min:100|max:'.(int)$request->balance,
                'collected'     => 'required|min:5|max:50',
            ]
            );

            $payment                = new Payment();
            $payment->preceiptno    = $request['receiptno'];
            $payment->preceiptdt    = $request['receiptdate'];
            $payment->pamount       = $request['amount'];
            $payment->pmode         = $request['mode'];
            $payment->receivedby    = $request['collected'];
            $payment->branch        = $request['branch'];
            $payment->cid           = $request['custid'];
            $payment->save();

            return redirect('payments')->with('message', 'Payment Successfully Added');
            die();
    }

}
