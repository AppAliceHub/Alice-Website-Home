<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alice Support</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        textarea {
            min-height: 150px;
            resize: vertical;
        }
        button {
            background-color: #000000;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #333333;
        }
        .success-message {
            display: none;
            color: #28a745;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #d4edda;
            border-radius: 4px;
        }
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #000;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        .loading::after {
            content: "⏳";
            animation: loading 1.5s infinite;
            font-size: 24px;
        }
        @keyframes loading {
            0% { opacity: 0.2; }
            50% { opacity: 1; }
            100% { opacity: 0.2; }
        }
        .field-error {
            border-color: #dc3545 !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Contact Support</h1>
            <p>Need help? We're here for you. Fill out the form below and we'll get back to you as soon as possible.</p>
        </div>
        
        <form id="supportForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
                <span id="nameError" class="error-message">Name is required</span>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <span id="emailError" class="error-message">Please enter a valid email address</span>
            </div>
            
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" required></textarea>
                <span id="messageError" class="error-message">Message is required</span>
            </div>
            
            <button type="submit">Send Message</button>
            
            <div id="loading" class="loading"></div>
        </form>
        
        <div id="successMessage" class="success-message">
            <h2>Thank you for your message!</h2>
            <p>We've received your inquiry and will get back to you as soon as possible.</p>
            <a href="/" class="back-link">← Back to homepage</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('supportForm');
            const successMessage = document.getElementById('successMessage');
            const loading = document.getElementById('loading');
            
            // Input validation
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const message = document.getElementById('message');
            
            const nameError = document.getElementById('nameError');
            const emailError = document.getElementById('emailError');
            const messageError = document.getElementById('messageError');
            
            // Validate email format
            function isValidEmail(email) {
                const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }
            
            // Show error for a field
            function showError(field, errorElement) {
                field.classList.add('field-error');
                errorElement.style.display = 'block';
            }
            
            // Hide error for a field
            function hideError(field, errorElement) {
                field.classList.remove('field-error');
                errorElement.style.display = 'none';
            }
            
            // Input event listeners for real-time validation
            name.addEventListener('input', function() {
                if (name.value.trim() !== '') {
                    hideError(name, nameError);
                }
            });
            
            email.addEventListener('input', function() {
                if (email.value.trim() !== '' && isValidEmail(email.value)) {
                    hideError(email, emailError);
                }
            });
            
            message.addEventListener('input', function() {
                if (message.value.trim() !== '') {
                    hideError(message, messageError);
                }
            });
            
            // Form submission
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                let isValid = true;
                
                // Validate name
                if (name.value.trim() === '') {
                    showError(name, nameError);
                    isValid = false;
                } else {
                    hideError(name, nameError);
                }
                
                // Validate email
                if (email.value.trim() === '' || !isValidEmail(email.value)) {
                    showError(email, emailError);
                    isValid = false;
                } else {
                    hideError(email, emailError);
                }
                
                // Validate message
                if (message.value.trim() === '') {
                    showError(message, messageError);
                    isValid = false;
                } else {
                    hideError(message, messageError);
                }
                
                if (isValid) {
                    // Show loading indicator
                    loading.style.display = 'block';
                    
                    // In a real implementation, you would send this data to a server
                    // For this example, we'll simulate a server request with a timeout
                    setTimeout(function() {
                        // Hide loading indicator
                        loading.style.display = 'none';
                        
                        // Hide the form
                        form.style.display = 'none';
                        
                        // Show success message
                        successMessage.style.display = 'block';
                        
                        // You can also use the mailto approach as a fallback
                        const mailtoLink = `mailto:hello@alicehub.app?subject=Support Request from ${encodeURIComponent(name.value)}&body=${encodeURIComponent(`Name: ${name.value}\nEmail: ${email.value}\n\nMessage:\n${message.value}`)}`;
                        
                        // Uncomment to automatically open the user's email client
                        // window.location.href = mailtoLink;
                        
                        // Log to console for debugging
                        console.log("Form submitted successfully");
                        console.log({
                            name: name.value,
                            email: email.value,
                            message: message.value
                        });
                    }, 1500); // Simulate 1.5 second server processing time
                }
            });
        });
    </script>
</body>
</html>

