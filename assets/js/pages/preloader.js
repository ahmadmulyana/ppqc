$(function() {
    function resetToDefaults() {
        topbar.config({
          autoRun      : true,
          barThickness : 3,
          barColors    : {
            '0'      : 'rgba(34,  77, 141, .9)',
            '.25'    : 'rgba(91,  206, 199, .9)',
            '.50'    : 'rgba(10, 148, 82,  .9)',
            '.75'    : 'rgba(255, 218, 23,  .9)',
            '1.0'    : 'rgba(204, 54,  54,   .9)'
          },
          shadowBlur   : 10,
          shadowColor  : 'rgba(0,   0,   0,   .6)'
        })
      }

      // Page load
      $(".wrapper").css("display", "none");
      resetToDefaults()
      topbar.show()
      setTimeout(function() {
        $(".wrapper").fadeIn("slow")
        topbar.hide()
      }, 1500)
})