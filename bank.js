// document.addEventListener("DOMContentLoaded", function() {
//   const payNowBtn = document.querySelector('button[type="submit"]');
//   payNowBtn.addEventListener('click', function(event) {
//     event.preventDefault();
//     const paymentOptions = document.querySelector('#payment-options');
//     const selectedOption = paymentOptions.querySelector('input:checked');

//     if (selectedOption.value === 'HLBank') {
//       let newWindow = window.open('https://www.hlb.com.my/en/personal-banking/home.html', '_blank');
//       setTimeout(function() {
//         newWindow.close();
//         window.location.href = 'pay_method.php';
//       }, 3000);
//     } else if (selectedOption.value === 'PayPal') {
//       let newWindow = window.open('https://www.paypal.com/my/home', '_blank');
//       setTimeout(function() {
//         newWindow.close();
//         window.location.href = 'pay_method.php';
//       }, 3000);
//     } else if (selectedOption.value === 'CIMB') {
//       let newWindow = window.open('https://www.cimbclicks.com.my/', '_blank');
//       setTimeout(function() {
//         newWindow.close();
//         window.location.href = 'pay_method.php';
//       }, 3000);
//     }
//   });
// });

document.addEventListener("paybtn", function() {
    
  let pay_method = getElementByName("paymentMethod");

      if (pay_method === 'HLBank') {
        let newWindow = window.open('https://www.hlb.com.my/en/personal-banking/home.html', '_blank');
        setTimeout(function() {
          newWindow.close();
          window.location.href = 'pay_method.php';
        }, 3000);
      } else if (pay_method === 'PayPal') {
        let newWindow = window.open('https://www.paypal.com/my/home', '_blank');
        setTimeout(function() {
          newWindow.close();
          window.location.href = 'pay_method.php';
        }, 3000);
      } else if (pay_method === 'CIMB') {
        let newWindow = window.open('https://www.cimbclicks.com.my/', '_blank');
        setTimeout(function() {
          newWindow.close();
          window.location.href = 'pay_method.php';
        }, 3000);
      }
    });
  
