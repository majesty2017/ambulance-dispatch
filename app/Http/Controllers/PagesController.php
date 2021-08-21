<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Account Settings
  public function account_settings()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Account Settings"]];
    return view('/content/pages/page-account-settings', ['breadcrumbs' => $breadcrumbs]);
  }

  // Profile
  public function profile()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Profile"]];

    return view('/content/pages/page-profile', ['breadcrumbs' => $breadcrumbs]);
  }

    public function update_profile(Request $request)
    {
        $profile = User::find(auth()->id());
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->other_name = $request->other_name;
        $profile->email = $request->email;
        if (!empty($request->password)) {
            $v = Validator::make($request->all(), [
                'paasword' => 'min:8|confirmed'
            ]);
            if ($v->fails()) {
                return response()->json(['status' => 'fail', 'error' => $v->errors()]);
            }
        }
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('images/profile/user-uploads', $filename);
            $profile->profile = $filename;
        }

        if ($profile->update()) {
            return response()->json(['message' => 'Record saved successfully.']);
        }
        return false;
    }

  // FAQ
  public function faq()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "FAQ"]];
    return view('/content/pages/page-faq', ['breadcrumbs' => $breadcrumbs]);
  }

  // Knowledge Base
  public function knowledge_base()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Knowledge Base"]];
    return view('/content/pages/page-knowledge-base', ['breadcrumbs' => $breadcrumbs]);
  }

  // Knowledge Base Category
  public function kb_category()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "/page/knowledge-base", 'name' => "Knowledge Base"], ['name' => "Category"]];
    return view('/content/pages/page-kb-category', ['breadcrumbs' => $breadcrumbs]);
  }

  // Knowledge Base Question
  public function kb_question()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "/page/knowledge-base", 'name' => "Knowledge Base"], ['link' => "/page/kb-category", 'name' => "Category"], ['name' => "Question"]];
    return view('/content/pages/page-kb-question', ['breadcrumbs' => $breadcrumbs]);
  }

  // pricing
  public function pricing()
  {
    $pageConfigs = ['pageHeader' => false];
    return view('/content/pages/page-pricing', ['pageConfigs' => $pageConfigs]);
  }

  // blog list
  public function blog_list()
  {
    $pageConfigs = ['contentLayout' => 'content-detached-right-sidebar', 'bodyClass' => 'content-detached-right-sidebar'];

    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "javascript:void(0)", 'name' => "Blog"], ['name' => "List"]];

    return view('/content/pages/page-blog-list', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs]);
  }

  // blog detail
  public function blog_detail()
  {
    $pageConfigs = ['contentLayout' => 'content-detached-right-sidebar', 'bodyClass' => 'content-detached-right-sidebar'];

    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "javascript:void(0)", 'name' => "Blog"], ['name' => "Detail"]];

    return view('/content/pages/page-blog-detail', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs]);
  }

  // blog edit
  public function blog_edit()
  {

    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "javascript:void(0)", 'name' => "Blog"], ['name' => "Edit"]];

    return view('/content/pages/page-blog-edit', ['breadcrumbs' => $breadcrumbs]);
  }
}
