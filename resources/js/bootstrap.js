import feather from 'feather-icons'
import Pikaday from 'pikaday'

try {
  const setUpUiLibraries = () => {
    feather.replace()
  }

  const datePicker = (id) => {
    return {
      picker: null,
      id: null,
      dispatch: null,
      init (id, dispatch) {
        this.id = id
        this.dispatch = dispatch
        this.picker = new Pikaday({
          field: this.$refs[this.id],
          format: "YYYY-MM-DD",
          onSelect: this.onSelect.bind(this)
        })
      },
      onSelect (date) {
        this.dispatch("input", this.picker.toString("YYYY-MM-DD"));
      }
    }
  }

  // require('bootstrap')
  document.addEventListener("DOMContentLoaded", () => {
    setUpUiLibraries()

    Livewire.hook('message.processed', () => {
      setUpUiLibraries()
    })
  })

  window.laravelViews = {
    datePicker
  }
} catch (e) {}