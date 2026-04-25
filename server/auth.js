// Authentication system (JWT based)
const express = require('express');
const router = express.Router();
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const mongoose = require('mongoose');

const User = mongoose.model('User', {
  email: String,
  password: String
});

const SECRET = 'vivid_secret_key';

// Register
router.post('/register', async (req, res) => {
  const { email, password } = req.body;
  const hashed = await bcrypt.hash(password, 10);

  const user = new User({ email, password: hashed });
  await user.save();

  res.json({ message: 'User registered' });
});

// Login
router.post('/login', async (req, res) => {
  const { email, password } = req.body;
  const user = await User.findOne({ email });

  if (!user) return res.status(400).json({ error: 'User not found' });

  const valid = await bcrypt.compare(password, user.password);
  if (!valid) return res.status(400).json({ error: 'Invalid password' });

  const token = jwt.sign({ id: user._id }, SECRET);
  res.json({ token });
});

module.exports = router;