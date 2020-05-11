import $ from 'jquery'
import feather from 'feather-icons'
import Pikaday from 'pikaday'
import moment from 'moment'
import alpine from 'alpinejs'

try {
  // window.$ = window.jQuery = require('jquery')

  // require('bootstrap')
  $(document).ready(function() {
    setUpUiLibraries()
  });

  $(document).on("livewire:load", () => {
    window.livewire.hook('afterDomUpdate', () => {
      setUpUiLibraries()
    })
  })

  window.laravelViews = {
    Pikaday: Pikaday
  }

  window.Alpine = alpine
} catch (e) {}

const setUpUiLibraries = () => {
  feather.replace()
}