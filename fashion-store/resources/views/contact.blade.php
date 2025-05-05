
  {{-- <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Contact Us') }}
      </h2>
  </x-slot> --}}
    <style>
     
     body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
  background-color: #f9f9f9;
}
.container-c {
  
  margin: 100px;
  
  background-color: white;
  border-radius: 2px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  padding: 30px;
  width: 85%;
  max-width: 450px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border: 1px solid #f0f0f0;
}

.container-c:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
}

/* Heading styles */
h2 {
  color: #000000;
  text-align: center;
  margin-bottom: 25px;
  font-size: 24px;
  position: relative;
  font-weight: 300;
  text-transform: uppercase;
  letter-spacing: 2px;
}

h2:after {
  content: '';
  position: absolute;
  width: 40px;
  height: 1px;
  background-color: #ffd1dc; /* Pink/Skin color */
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  transition: width 0.3s ease;
}

.container-c:hover h2:after {
  width: 70px;
}

/* Form elements styling */
#contact-form {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.inp, textarea {
  padding: 14px;
  border: none;
  border-bottom: 1px solid #e0e0e0;
  border-radius: 0;
  font-size: 14px;
  transition: all 0.3s ease;
  outline: none;
  background-color: #fcfcfc;
  font-family: 'Montserrat', sans-serif;
}

.inp:focus, textarea:focus {
  border-bottom-color: #ffd1dc; /* Pink/Skin color */
  box-shadow: 0 1px 0 0 rgba(255, 209, 220, 0.3);
  background-color: white;
}

/* Button styling */
.bttn {
  background-color: #000000;
  color: white;
  border: none;
  padding: 14px;
  font-size: 14px;
  font-weight: 400;
  border-radius: 0;
  cursor: pointer;
  transition: all 0.3s ease;
  letter-spacing: 2px;
  margin-top: 10px;
  text-transform: uppercase;
}

.bttn:hover {
  background-color: #333333;
  transform: translateY(-2px);
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

.bttn:active {
  transform: translateY(0);
}

/* Feedback message styling */
#feedback, #loading {
  text-align: center;
  margin-top: 15px;
  font-weight: 400;
  font-size: 14px;
  letter-spacing: 1px;
}

#feedback {
  color: #000000;
}

#loading {
  color: #000000;
}

/* Error message styling */
.error-message {
  color: #d32f2f;
  font-size: 12px;
  margin-top: 5px;
  text-align: center;
  letter-spacing: 0.5px;
}

/* Remove animation for more elegance */
.inp:focus, textarea:focus {
  animation: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .container-c {
    width: 90%;
    padding: 25px 20px;
  }
  
  h2 {
    font-size: 20px;
  }
  
  .inp, textarea, .bttn {
    padding: 12px;
    font-size: 13px;
  }
}

/* Placeholder styling */
::placeholder {
  color: #c0c0c0;
  opacity: 0.9;
  font-weight: 300;
  letter-spacing: 0.5px;
}

.inp:hover, textarea:hover {
  border-bottom-color: #ffd1dc;
  background-color: rgba(255, 255, 255, 0.8);
}

/* Success feedback styling */
#feedback {
  padding: 8px;
  color: #000000;
  border-bottom: 1px solid #ffd1dc;
}

/* Textarea specific */
textarea {
  height: 120px;
  border: 1px solid #e0e0e0;
}

textarea:focus {
  border-color: #ffd1dc;
}

main {
  display: flex;
  justify-content: center;
  align-content: center;
  margin: 5vh auto;
}

    </style>
  <body class="body-b" >
    <div class="container-c">
      <h2>Contact Us</h2>
      <form id="contact-form">
        <input type="text" id="name" placeholder="Name" name="name" required class="inp" />
        <input type="text" id="phone" placeholder="070-000-000-0" name="phone" required class="inp" />
        <input type="email" id="email" placeholder="Email" name="email" required class="inp" />
        <textarea id="message" name="message" placeholder="Your message..." required style="resize: vertical; width: 100%; height: 150px"></textarea>
        <button type="submit" class="bttn">Submit</button>
      </form>
      <p id="loading" style="display: none; color: blue">Sending...</p>
      <p id="feedback" style="display: none; color: green">Your message has been sent successfully!</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function () {
        emailjs.init("Hg_bctqQtq2raKq_1"); // User ID

        $("#contact-form").submit(function (event) {
          event.preventDefault();
          $("#loading").show();
          $("#feedback").hide();
          $(".error-message").remove();

          let name = $("#name").val().trim();
          let email = $("#email").val().trim();
          let phone = $("#phone").val().trim();
          let message = $("#message").val().trim();

          let formValid = true;
          if (!name || !email || !phone || !message) {
            formValid = false;
            showError("All fields are required!");
          }
          if (!validateName(name)) {
            formValid = false;
            showError("Please enter a valid name (only letters).");
          }
          if (!validateEmail(email)) {
            formValid = false;
            showError("Please enter a valid email address.");
          }
          if (!validatePhone(phone)) {
            formValid = false;
            showError("Please enter a valid phone number (10-15 digits).");
          }
          if (!formValid) {
            $("#loading").hide();
            return;
          }

          let params = { name, email, phone, message };
          emailjs.send("service_843dy3s", "template_mgzxx43", params)
            .then(() => {
              $("#feedback").show();
              $("#loading").hide();
              $("#contact-form")[0].reset();
            })
            .catch((error) => {
              alert("Failed to send email.");
              console.error("FAILED...", error);
            })
            .always(() => {
              $("#loading").hide();
            });
        });

        function validateEmail(email) {
          const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          return re.test(String(email).toLowerCase());
        }

        function validateName(name) {
          const re = /^[a-zA-Z؀-ۿ\s]+$/;
          return re.test(String(name));
        }

        function validatePhone(phone) {
          const re = /^\+?\d{10,15}$/;
          return re.test(String(phone));
        }

        function showError(message) {
          let errorSpan = $('<span class="error-message" style="color: red;"></span>').text(message);
          $("#contact-form").append(errorSpan);
        }
      });
    </script>
  </body>
</html>