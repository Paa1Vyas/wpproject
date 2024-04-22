import React, { useState, useEffect } from 'react';

function OrderForm() {
  const [formData, setFormData] = useState({
    product_name: '',
    product_price: '',
    category: '',
    c_name: '',
    mobile_number: '',
    email: '',
    address: '',
    pid: 'P03',
    c_id: 'c02'
  });

  useEffect(() => {
    fetchData();
  }, []); // Fetch data when component mounts

  const fetchData = () => {
    // Fetch data from backend API or adjust as needed
    // Replace this with actual API call
    fetch('backend_endpoint_url') // Change to your actual endpoint
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        // Assuming the response data matches the structure of formData
        setFormData(data);
      })
      .catch(error => console.error('Error fetching data:', error));
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prevState => ({
      ...prevState,
      [name]: value
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Submit form data to backend API or handle as needed
    // Replace this with actual API call
    console.log(formData); // Just for demonstration
  };

  return (
    <div>
      <h2>Order Form</h2>
      <form onSubmit={handleSubmit}>
        <h3>Product</h3>
        <label htmlFor="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value={formData.product_name} onChange={handleChange} /><br /><br />

        <label htmlFor="product_price">Product Price:</label>
        <input type="text" id="product_price" name="product_price" value={formData.product_price} onChange={handleChange} /><br /><br />

        <label htmlFor="category">Category:</label>
        <input type="text" id="category" name="category" value={formData.category} onChange={handleChange} /><br /><br />

        <h3>Customer Details</h3>
        <label htmlFor="c_name">Customer Name:</label>
        <input type="text" id="c_name" name="c_name" value={formData.c_name} onChange={handleChange} /><br /><br />

        <label htmlFor="mobile_number">Mobile Number:</label>
        <input type="text" id="mobile_number" name="mobile_number" value={formData.mobile_number} onChange={handleChange} /><br /><br />

        <label htmlFor="email">Email:</label>
        <input type="email" id="email" name="email" value={formData.email} onChange={handleChange} /><br /><br />

        <label htmlFor="address">Address:</label>
        <textarea id="address" name="address" value={formData.address} onChange={handleChange}></textarea><br /><br />

        <input type="submit" value="Submit" />
      </form>
    </div>
  );
}

export default OrderForm;
