export default function ({ store }) {
  store.app.router.beforeEach((to, from, next) => {
    let a = 1
    if (a == 1) {
      next()
    } else {
      next(false)
    }
  })
}
