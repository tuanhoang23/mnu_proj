<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $uniqueEmail = 'unique:users';
        if(session('id')){
            $id = session('id');
            $uniqueEmail = 'unique:users,email,'.$id;
        }
    
        return [
            'fullname' => 'required|min:5',
            'email' => 'required|email|'.$uniqueEmail,
            'group_id' => ['required','integer',function($attribute, $value, $fail){
                if($value == 0){
                    $fail('Bắt buộc phải chọn nhóm');
                }
            }],
            'status' => 'required|integer',
        ];
    }

    public function messages(){
        return [
            'fullname.required' => 'Họ tên bắt buộc phải nhập',
            'fullname.min' => 'Họ tên không được nhỏ hơn 5 ký tự',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email phải nhập đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'group_id.required' => 'Phải chọn nhóm',
            'group_id.integer' => 'Nhóm không hợp lệ',
            'status.required' => 'Trạng thái không được trống',
            'status.integer' => 'Trạng thái không hợp lệ'
        ];
    }
}
