// server.js
const express = require('express');
const cors = require('cors');
const multer = require('multer');
const path = require('path');

const app = express();
const port = 3000;

// Enable CORS
app.use(cors());

// Set up Multer for file uploads
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, path.join(__dirname, 'uploads/'));
  },
  filename: (req, file, cb) => {
    cb(null, file.originalname);
  },
});

const upload = multer({ storage: storage });

// Serve static files from the 'uploads' directory
app.use('/uploads', express.static('uploads'));

// Define a route for the root URL
app.get('/', (req, res) => {
  res.send('Hello, this is your server!');
});

// Define a route for handling form submissions
app.post('/submit-form', upload.single('image'), (req, res) => {
  const formData = req.body; // Assuming you're sending JSON data
  const image = req.file; // Access the uploaded image using req.file

  // Process the form data, save to a database, etc.
  console.log('Received form submission:', formData);
  console.log('Received image:', image);

  // Send a response back to the client
  res.send('Form submitted successfully!');
});

// Start the server
app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
