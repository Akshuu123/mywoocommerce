$(document).ready(() => {
    $('.survey_form').submit((event) => {
        event.preventDefault();
        let namee = $('#name').val();
        let race = $('#race_ethnicity').val();
        let sex = $('#biological_Sex').val();
        let dob = $('#date_of_birth').val();
        let zipcode = $('#zipcode').val();
        let maritalstatus = $('#marital_status').val();
        let children = $('#children').val();
        let education = $('#education').val();
        let employement_status = $('#employement_status').val();
        let contact = $('#contact').val();
        let email = $('#email').val();
        let formData = [namee, race, sex, dob, zipcode, maritalstatus, children, education,
            employement_status, contact, email]
        if (namee === '' || race === '' || sex === '' || dob === '' || zipcode === '' || maritalstatus === '' || children === '' || education === '' || employement_status === ''
            || contact === '' || email === ''
        ) {
            $('#errorDiv').css({ display: 'block', color: 'red' });

            $('#errorDiv').text('All Fields Required Mandatory');
        } else {

            $.ajax(
                {
                    method: 'POST',
                    url: ajax_object.ajax_url,
                    data: {
                        action: 'submit_survey',
                        survey_data: [namee, race, sex, dob, zipcode, maritalstatus, children, education,
                            employement_status, contact, email],
                    },
                    success: (responseText) => {
                        $('#errorDiv').css({ display: 'block', color: 'green' });
                        $('#errorDiv').text(responseText['message']);
                        // setTimeout(function () { location.reload() }, 1000);

                        for (let i = 0; i < formData.length; i++) {
                            let element = formData[i];
                            element = '';
                            console.log('all elements empty');
                        }

                    },

                    error: (xhr, status, error) => {
                        console.log(error);
                    }
                }
            )
            
        }
    })
});

