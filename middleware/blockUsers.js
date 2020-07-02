export default function({ $auth,redirect,$swal }) {
    if(!$auth.loggedIn) {
        return  redirect('/dang-nhap');
    }
    if($auth.user.role == 1) {
        return  redirect('/admin');
    }
}