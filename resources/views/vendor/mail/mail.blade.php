
<style type="text/css">
	/*! Email Template */
.table {
  --bs-table-color: #526484;
  --bs-table-bg: transparent;
  --bs-table-border-color: #dbdfea;
  --bs-table-accent-bg: #fff;
  --bs-table-striped-color: #526484;
  --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
  --bs-table-active-color: var(--bs-body-color);
  --bs-table-active-bg: #f5f6fa;
  --bs-table-hover-color: var(--bs-body-color);
  --bs-table-hover-bg: #f5f6fa;
  width: 100%;
  margin-bottom: 1rem;
  color: var(--bs-table-color);
  vertical-align: top;
  border-color: var(--bs-table-border-color);
}
.email-wraper {
  background: #f5f6fa;
  font-size: 14px;
  line-height: 22px;
  font-weight: 400;
  color: #526484;
  width: 100%;
  font-family: DM Sans, sans-serif;
}
.email-wraper a {
  color: #854fff;
  word-break: break-all;
}
.email-wraper .link-block {
  display: block;
}
.email-ul {
  margin: 5px 0;
  padding: 0;
}
.email-ul:not(:last-child) {
  margin-bottom: 10px;
}
.email-ul li {
  list-style: disc;
  list-style-position: inside;
}
.email-ul-col2 {
  display: flex;
  flex-wrap: wrap;
}
.email-ul-col2 li {
  width: 50%;
  padding-right: 10px;
}
.email-body {
  width: 96%;
  max-width: 620px;
  margin: 0 auto;
  background: #ffffff;
}
.email-success {
  border-bottom: #1ee0ac;
}
.email-warning {
  border-bottom: #f4bd0e;
}
.email-btn {
  background: #854fff;
  border-radius: 4px;
  color: #ffffff !important;
  display: inline-block;
  font-size: 13px;
  font-weight: 600;
  line-height: 44px;
  text-align: center;
  text-decoration: none;
  text-transform: uppercase;
  padding: 0 30px;
}
.email-btn-sm {
  line-height: 38px;
}
.email-header, .email-footer {
  width: 100%;
  max-width: 620px;
  margin: 0 auto;
}
.email-logo {
  height: 40px;
}
.email-title {
  font-size: 13px;
  color: #854fff;
  padding-top: 12px;
}
.email-heading {
  font-size: 18px;
  color: #854fff;
  font-weight: 600;
  margin: 0;
  line-height: 1.4;
}
.email-heading-sm {
  font-size: 24px;
  line-height: 1.4;
  margin-bottom: 0.75rem;
}
.email-heading-s1 {
  font-size: 20px;
  font-weight: 400;
  color: #526484;
}
.email-heading-s2 {
  font-size: 16px;
  color: #526484;
  font-weight: 600;
  margin: 0;
  text-transform: uppercase;
  margin-bottom: 10px;
}
.email-heading-s3 {
  font-size: 18px;
  color: #854fff;
  font-weight: 400;
  margin-bottom: 8px;
}
.email-heading-success {
  color: #1ee0ac;
}
.email-heading-warning {
  color: #f4bd0e;
}
.email-note {
  margin: 0;
  font-size: 13px;
  line-height: 22px;
  color: #8094ae;
}
.email-copyright-text {
  font-size: 13px;
}
.email-social li {
  display: inline-block;
  padding: 4px;
}
.email-social li a {
  display: inline-block;
  height: 30px;
  width: 30px;
  border-radius: 50%;
  background: #ffffff;
}
.email-social li a img {
  width: 30px;
}

@media (max-width: 480px) {
  .email-preview-page .card {
    border-radius: 0;
    margin-left: -20px;
    margin-right: -20px;
  }
  .email-ul-col2 li {
    width: 100%;
  }
}
.py-5 {
  padding-top: 2.75rem !important;
  padding-bottom: 2.75rem !important;
}
.text-center {
  text-align: center !important;
}
.pb-4 {
  padding-bottom: 1.5rem !important;
}
.px-3 {
  padding-right: 1rem !important;
  padding-left: 1rem !important;
}
  .px-sm-5 {
    padding-right: 2.75rem !important;
    padding-left: 2.75rem !important;
  }
  .pt-3 {
  padding-top: 1rem !important;
}
.pb-3 {
  padding-bottom: 1rem !important;
}
  .pt-sm-5 {
    padding-top: 2.75rem !important;
  }
.pb-2 {
  padding-bottom: 0.75rem !important;
}
.mb-4 {
  margin-bottom: 1.5rem !important;
}
</style>

<table class="email-wraper">
	<tr>
		<td class="py-5">
			<table class="email-header">
				<tbody>
					<tr>
						<td class="text-center pb-4">
							<a href="#"><img class="email-logo" src="{{ asset('assets/images/logo-dark2x.png') }}" alt="logo"></a>
							<p class="email-title">Conceptual Base Modern Dashboard Theme</p>
						</td>
					</tr>
				</tbody>
			</table>
			<table class="email-body">
				<tbody>
					<tr>
						<td class="px-3 px-sm-5 pt-3 pt-sm-5 pb-3">
							<h2 class="email-heading">Lakukan Pendaftaran Pengguna Baru</h2>
						</td>
					</tr>
					<tr>
						<td class="px-3 px-sm-5 pb-2">
							<p>Hi {{ $data->nama_pengguna }},</p>
							<p>Selamat Datang! <br> You are receiving this email because you have registered on our site.</p>
							<p>Click the link below to active your DashLite account.</p>
							<p class="mb-4">This link will expire in 15 minutes and can only be used once.</p>
							<a href="{{ route('register',$data->id_user) }}" class="email-btn">Register</a>
						</td>
					</tr>
					<tr>
						<td class="px-3 px-sm-5 pt-4">
							<h4 class="email-heading-s2">or</h4>
							<p>If the button above does not work, paste this link into your web browser:</p>
							<a href="#" class="link-block">{{ route('register',$data->id_user) }}</a>
						</td>
					</tr>
					<tr>
						<td class="px-3 px-sm-5 pt-4 pb-3 pb-sm-5">
							<p>If you did not make this request, please contact us or ignore this message.</p>
							<p class="email-note">This is an automatically generated email please do not reply to this email. If you face any issues, please contact us</p>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
</table>
