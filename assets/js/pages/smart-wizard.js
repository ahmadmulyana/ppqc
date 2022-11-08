$(document).ready(function(){
    var isStatus;
    var isStatusNext;

    if (page==="edit_nc"){
        isStatus = true;
        isStatusNext = false;
    }else if (page==="lihat_nc"){
        isStatus = true;
    }else{
        isStatus = false;
        isStatusNext = false;
    }

    $('#smartwizard').smartWizard({
        theme: 'dots',
        transition: {
            animation: 'slide-horizontal',
            speed: '1000',
            easing:''
        },

        toolbarSettings: {
            showPreviousButton : isStatusNext,
            showNextButton : isStatusNext
        },

        anchorSettings: {
            anchorClickable: true, // Enable/Disable anchor navigation
            enableAllAnchors: isStatusNext, // Activates all anchors clickable all times
            markDoneStep: false, // Add done state on navigation
            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        }
    });

});