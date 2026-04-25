// Node.js + Express Backend for Vivid Lanka
const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json());

// MongoDB اتصال
mongoose.connect('mongodb://127.0.0.1:27017/vivid-lanka')
.then(()=>console.log('MongoDB Connected'))
.catch(err=>console.log(err));

// Product Schema
const Product = mongoose.model('Product',{
  name:String,
  price:Number,
  image:String,
  description:String
});

// Routes
app.get('/api/products', async(req,res)=>{
  const products = await Product.find();
  res.json(products);
});

app.post('/api/products', async(req,res)=>{
  const p = new Product(req.body);
  await p.save();
  res.json(p);
});

// Order Schema
const Order = mongoose.model('Order',{
  items:Array,
  total:Number,
  createdAt:{type:Date,default:Date.now}
});

app.post('/api/orders', async(req,res)=>{
  const order = new Order(req.body);
  await order.save();
  res.json({message:'Order placed'});
});

app.listen(5000,()=>console.log('Server running on port 5000'));