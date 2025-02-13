<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data = Customer::when($request->has('search'), function ($query) use ($request) {
            $query->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('bank_account_number', 'like', '%' . $request->search . '%')
            ;
        })->orderBy('created_at', $request->order ?? 'desc')->get();

        // $data = $data->paginate(10);
        return view('customer.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        //
        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bank_account_number' => $request->bank_account_number,
            'about' => $request->about
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('', 'public');
            $image->move(public_path('uploads'), $filename);
            $filepath = '/uploads/' . $filename;

            $customer->update(['image' => $filepath]);
        }

        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Customer::findOrFail($id);
        return view('customer.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Customer::findOrFail($id);
        return view('customer.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerStoreRequest $request, string $id)
    {
        //
        $customer = Customer::findOrFail($id);

        $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bank_account_number' => $request->bank_account_number,
            'about' => $request->about
        ]);

        if ($request->hasFile('image')) {
            // delete old image
            File::delete(public_path($customer->image));

            // handle new image
            $image = $request->file('image');
            $filename = $image->store('', 'public');
            $image->move(public_path('uploads'), $filename);
            $filepath = '/uploads/' . $filename;

            $customer->update(['image' => $filepath]);
        }

        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        File::delete(public_path($customer->image));
        $customer->delete();

        return redirect()->route('customer.index');
    }

    public function trashIndex(Request $request)
    {
        // dd('masuk ke trash');
        // $data = Customer::onlyTrashed()->get();
        $data = Customer::query()->when($request->has('search'), function ($query) use ($request) {
            $query->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('bank_account_number', 'like', '%' . $request->search . '%')
            ;
        })->orderBy('created_at', $request->order ?? 'desc')->onlyTrashed()->get();

        // dd($data);

        // $data = $data->paginate(10);
        return view('customer.trash', compact('data'));
    }

    public function reestoreIndex(int $id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $customer->restore();
        return redirect()->back();
    }

    public function forceDestroy(int $id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $customer->forceDelete();
        return redirect()->back();
    }
}
