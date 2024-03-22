const stepsNavElements  = $('.wizard-step[data-wizard-type="step"]');
const stepsContent      = $('.wizard-step[data-wizard-type="step-content"]');
const stepBtns          = $('.step-btn');
const nextBtn           = $('#next-btn');
const prevBtn           = $('#prev-btn');
let   currentStep      = 1;
let   totalSteps        = stepsContent.length;

$(document).ready( () => {

    if( stepsNavElements.length !== stepsContent.length ) // throw an error if the steps headers and contents are not equal
        throw new Error('the number of steps headers not equal the steps contents');

    stepsNavElements.css('cursor','pointer'); // change the cursor style to all nav elements


    stepBtns.click( function () {

        let btnType = $(this).data('btn-type');


        if (btnType === "next")
        {
            validateStep(() => {
                currentStep++;
                showCurrStep()
            });
        } else
        {
            currentStep--;
            showCurrStep();
        }


    });

    stepsNavElements.click( function () {

        let clickedStep = $(this).data('index') + 1;

        if ( clickedStep >= currentStep )
        {
            validateStep(() => {
                currentStep = clickedStep;
                showCurrStep();
            });

        } else
        {
            currentStep = clickedStep;
            showCurrStep();
        }

    } )

});

let showCurrStep = () => {

    console.log("current"+currentStep);
    const currentIndex  = currentStep - 1;
    const stepContent   = stepsContent.eq(currentIndex);

    stepsNavElements.attr('data-wizard-state',''); // make all steps headers inactive
    stepsNavElements.eq(currentIndex).attr('data-wizard-state','current'); // make the current step header active

    stepContent.removeClass('d-none'); // show the clicked step content
    stepsContent.not( stepContent ).addClass('d-none'); // hide the others

    if ( currentIndex === 0 )
    {
        nextBtn.find('[class=indicator-label]').eq(0).text( __('Next') );
        prevBtn.addClass('d-none');
    }
    else if ( currentIndex === totalSteps - 1 )
    {
        nextBtn.find('[class=indicator-label]').eq(0).text( __('Submit') );
        nextBtn.addClass('btn-success');
        prevBtn.removeClass('d-none');
    }else
    {
        prevBtn.removeClass('d-none');
    }

};

