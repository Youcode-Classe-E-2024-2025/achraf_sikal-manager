<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Activation</title>
    <!-- Include Tailwind CSS (via CDN for simplicity) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

    <!-- Alert Box -->
    <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg w-80 text-center transform transition-all ease-in-out duration-500 opacity-0 scale-90 animate-fade-in">
        <h2 class="text-2xl font-semibold">Profile Activation Pending</h2>
        <p class="mt-4 text-lg">Please wait for your profile to be activated. You will be notified once it's ready!</p>
        <button class="mt-6 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none" onclick="closeAlert()">Ok</button>
    </div>

    <script>
        // Function to close the alert box when "Ok" is clicked
        function closeAlert() {
            const alertBox = document.querySelector('.bg-yellow-500');
            alertBox.classList.add('opacity-0');
            alertBox.classList.add('scale-90');
            alertBox.classList.remove('animate-fade-in');
        }
    </script>
</body>
</html>
