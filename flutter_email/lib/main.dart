import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter_email/views/sendmail.dart';

void main() {
  HttpOverrides.global = MyHttpOverrides();
  runApp(const MyEmail());
}

class MyEmail extends StatelessWidget {
  const MyEmail({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      // initialRoute: '/',
      // routes: {
      //   '/':(context) => Sendmail(),
      // }
      home: Sendmail(),
    );
  }
}

class MyHttpOverrides extends HttpOverrides {
  @override
  HttpClient createHttpClient(SecurityContext? context) {
    return super.createHttpClient(context)
      ..badCertificateCallback =
          (X509Certificate cert, String host, int port) => true;
  }
}

