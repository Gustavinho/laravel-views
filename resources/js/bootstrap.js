import feather from 'feather-icons'

try {
  const setUpUiLibraries = () => {
    feather.replace()
  }

  document.addEventListener("DOMContentLoaded", () => {
    setUpUiLibraries()

    Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
      // Equivalent of 'message.sent'

      succeed(({ snapshot, effect }) => {
        // Equivalent of 'message.received'

        queueMicrotask(() => {
          // Equivalent of 'message.processed'
          setUpUiLibraries()
        })
      })

      fail(() => {
        // Equivalent of 'message.failed'
      })
    })
  })
} catch (error) {
  throw new Error(error)
}