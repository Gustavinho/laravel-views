import feather from 'feather-icons'

try {
  const setUpUiLibraries = () => {
    feather.replace()
  }

  document.addEventListener("DOMContentLoaded", () => {
    setUpUiLibraries()

    Livewire.hook('message.processed', () => {
      setUpUiLibraries()
    })
  })
} catch (error) {
  throw new Error(error)
}