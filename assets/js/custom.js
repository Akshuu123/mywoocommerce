// $(document).ready(function () {
//     $('.survey_form').click(function (e) { 
//         e.preventDefault();
//         console.log(e);       
//     });
// });
// jQuery(document).ready(() => {
//     $('#forminput').click(function (event) {
//         event.preventDefault();
//         // let myForm = $('.survey_form');
//         let formdata = jQuery('.survey_form').serialize();

//         // let namee = $('#name').val();
//         // let race = $('#race_ethnicity').val();
//         // let sex = $('#biological_Sex').val();
//         // let dob = $('#date_of_birth').val();
//         // let zipcode = $('#zipcode').val();
//         // let maritalstatus = $('#marital_status').val();
//         // let children = $('#children').val();
//         // let education = $('#education').val();
//         // let employement_status = $('#employement_status').val();
//         // let contact = $('#contact').val();
//         // let email = $('#email').val();
//         // let file = $('#file').val();
//         // let formData = [namee, race, sex, dob, zipcode, maritalstatus, children, education,
//         //     employement_status, contact, email, file]
//         // $.each(formData, function (indexInArray, valueOfElement) {
//         //     console.log(valueOfElement);
//         //     if (valueOfElement !== "" && valueOfElement !== null) {
//         //         console.log(`This index${indexInArray} of element is empty`)
//         //     } else {
//         //         console.log("every thing fin");
//         //     }
//         // });

//         $.ajax(
//             {
//                 method: 'POST',
//                 url: ajax_object.ajax_url,
//                 data: {
//                     action: 'submit_survey',
//                     form_data: formdata,
//                     // namee:namee,
//                     // filee:file 
//                 },
//                 // processData:false,
//                 // contentType:false,  
//                 success: (responseText) => {
//                     console.log(responseText.message)
//                 }
//             }
//         )
//     });
// });



// // $(document).ready(function () {
// //     $('.survey_form').submit(function (e) {
// //         e.preventDefault();
// //         let form = document.getElementsByClassName('survey_form');
// //         let file = form[0][0].value;
// //         $.ajax(
// //             {
// //                 method: 'POST',
// //                 url: ajax_object.ajax_url,
// //                 data: {
// //                     action: 'submit_survey',
// //                     survey_data: file,
// //                 },
// //                 success: (responseText) => {
// //                     $('#errorDiv').css({ display: 'block', color: 'green' });
// //                     $('#errorDiv').text(responseText['message']);

// //                     // setTimeout(function () { location.reload() }, 1000);

// //                     $('form').empty();
// //                     console.log('all elements empty');

// //                 },
// //                 error: (xhr, status, error) => {
// //                     console.log(error);
// //                 }
// //             }
// //         )

// //     });
// // });


// // get data through ajax in input field
// jQuery(document).ready(function () {
//     jQuery('#wp-block-search__input-5').on('keyup', function (e) {
//         e.preventDefault();
//         var searchTerm = jQuery('#wp-block-search__input-5').val();
//         setTimeout(searchPosts(searchTerm),2000);

//     });

//     function searchPosts(searchTerm) {
//         jQuery.ajax({
//             url: ajax_params.ajax_url,
//             type: 'POST',
//             data: {
//                 action: 'search_posts',
//                 searchTerm: searchTerm
//             },
//             beforeSend: function () {
//                 // Clear previous results
//                 jQuery('.ajax_result_ul').empty();
//             },
//             success: function (response) {
//                 // create element


//                 let ul=jQuery('.ajax_result_ul');
//                 jQuery.each(response, function (index, post) {
//                     // // let ul = $('<ul></ul>');

//                     // // console.log(ajax_result);
//                     console.log(response);
//                      li = $('<li></li>');
//                     if (response=="") {

//                         let a = $('<a></a>').text("Sorry No Result Found");
//                         ul.append(li);
//                         li.append(a);
//                     }else{


//                         let a = $('<a></a>').attr({ 'href': post.link }).text(post.title);

//                         // ajax_result.append(ul);
//                         ul.append(li);
//                         li.append(a);

//                     }
//                 });
//                 jQuery('.ajax_result').css("display","flex");
//             }

//             ,
//             error: function (error) {
//                 console.error('Error: ' + error.responseText);
//             }
//         });
//     }
// });
// let ajax_result=$('.ajax_result');


/** Use ajax for Custom Form */
$(document).ready(function () {
  $('.main_custom_form').submit(function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Serialize the form data
    let formData = $(this).serialize();

    // Output the serialized form data to the console (you can modify this as needed)
    // console.log(formData);
    $.ajax({
      type: "post",
      url: 'http://localhost/woocommerce/wp-admin/admin-ajax.php',
      data: {
        action: 'customform',
        formdata: formData
      },
      success: function (response) {
        console.log(response);
        openPopup(response.message, response.formdata.question, response.formdata.answer);
        alert(`The id of post is ${response.post_id}`)
      },
      error: function (err) {
        console.log(err.message);
      }
    });
  });
});
let popmessage = {
  color: 'green',

}
function openPopup(message, question, answer) {
  document.getElementById('popupMessage').innerText = message;
  $('#popupMessage').text(message).css({ 'color': 'blue' });
  $('#popupQues').text(question).css({ 'color': 'black' });
  $('#popupAns').text(answer).css({ 'color': 'dimgray' });

  document.getElementById('popup').style.display = 'block';
  document.getElementById('overlay').style.display = 'block';
}

function closePopup() {
  $('.main_custom_form').get(0).reset();
  document.getElementById('popup').style.display = 'none';
  document.getElementById('overlay').style.display = 'none';
}


/**custom field in input handle on single product page */
// jQuery(document).ready(function(){
//   let btn=$('.single_add_to_cart_button');
//   btn.on('click',function(event){
//     event.preventDefault();
//     console.log(this);
//   })
// })