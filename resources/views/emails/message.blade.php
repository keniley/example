
@extends ('emails.layout.html')

@section ('css')
@endsection

@section ('content')
    <span class="preheader">We received a request to reset your password with this email address.</span>
    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
      <tr>
        <td align="center">
          <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
              <td class="email-masthead">
                <a href="https://www.avantyna.cz" class="f-fallback email-masthead_name">
                Avantina Italština
              </a>
              </td>
            </tr>
            <!-- Email Body -->
            <tr>
              <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
                <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                  <!-- Body content -->
                  <tr>
                    <td class="content-cell">
                      <div class="f-fallback">
                        <p>We received a request to reset the password to access [Product Name] with your email address () from a  device using, but we were unable to find an account associated with this address.</p>
                        <p>If you use [Product Name] and were expecting this email, consider trying to request a password reset using the email address associated with your account.</p>
                        <!-- Action -->
                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                          <tr>
                            <td align="center">
                              <!-- Border based button
                                https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design 
                              -->
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                <tr>
                                  <td align="center">
                                    <a href="" class="f-fallback button button--blue" target="_blank">Try a different email</a>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                        <p>If you do not use [Product Name] or did not request a password reset, please ignore this email or <a href="">contact support</a> if you have questions.</p>
                        <p>Thanks,
                          <br>The [Product Name] Team</p>
                        <!-- Sub copy -->
                        <table class="body-sub" role="presentation">
                          <tr>
                            <td>
                              <p class="f-fallback sub">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
                              <p class="f-fallback sub"></p>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                  <tr>
                    <td class="content-cell" align="center">
                      <p class="f-fallback sub align-center">&copy; 2019 Avantina.cz.</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
@endsection
