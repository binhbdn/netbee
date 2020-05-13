export default function({ $auth,redirect,$swal }) {
    if(!$auth.loggedIn) {
        return  redirect('/dang-nhap');
    }
    if($auth.user.role == 2 && $auth.user.nb_company == null) {
        return  redirect('/admin/thong-tin-tai-khoan');
    }
}