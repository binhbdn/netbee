export default function({ $auth,redirect,$swal }) {
    if($auth.user.role == 2 && $auth.user.nb_company == null && $auth.user.status == 0) {
        return  redirect('/admin/thong-tin-tai-khoan');
    }
}