const express =  require('express');
const webPush =  require('web-push');
const bodyParser = require('body-parser');
const path = require('path');
require('dotenv').config();

const app = express();

//Set Static Path
app.use(express.static(path.join(__dirname, 'client')));

app.use(bodyParser.json());

webPush.setVapidDetails('mailto:contact@doctorwhofans.be', process.env.publicVapidKey, process.env.privateVapidKey);

// Subscribe route

app.post('/subscribe', (req, res) => {

  //Get pushSubcripotion object
  const subscription = req.body;

  // Create payload
  const payload = JSON.stringify({ title: 'Push Test' });

  // Pass object into sendNotification
  webPush.sendNotification(subscription, payload).catch(err => console.error(err));

  res.status(201).json({});
});

const port = process.env.PORT || 5000;

app.listen(port, () => console.log(`Server started on port ${port}`));