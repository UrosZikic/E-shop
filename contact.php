<div name="contact-form" class="form-container disappear">
  <p class="form-notification">

  </p>
  <button class="close-form">Exit</button>
  <label for="from_name">Name</label>
  <input id="from_name" name="from_name" type="text" required />
  <label for="email">Email</label>
  <input type="email" name="email" id="email" required />
  <label for="subject">Subject</label>
  <input type="text" id="subject" name="subject" required />
  <label for="message">Message</label>
  <textarea name="message" id="message" cols="30" rows="10"></textarea>
  <button class="button-form--submit" onclick="sendMail();">Send</button>
</div>