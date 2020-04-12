export default function({ store, auth }) {
    console.log(auth);
    if(store.getters['authenticated']) {
        return redirect('/');
    }
}