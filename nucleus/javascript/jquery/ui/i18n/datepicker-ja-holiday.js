
function beforeShowDay_ja_holiday(date) {
	var weekday = date.getDay();
	var res = check_ja_holiday(date);
	var newClassName = "datepicker-"+$.datepicker.regional[""].dayNames[weekday].toLowerCase();
	if (res == false) {
		var yes = new Date(date);
		yes.setTime(date.getTime());
		yes.setDate(date.getDate() - 1);
		if (1==weekday && check_ja_holiday(yes)!=false) {
			res = "振替休日";
			if (-1 != check_ja_holiday(yes).indexOf('？')) {
				return [true, newClassName + " datepicker-holiday_undefined", "？"+res+"？"];
			}
		} else {
			return [true, newClassName, ""];
		}
	}
	if (-1 != res.indexOf('？')) {
		return [true, newClassName + " datepicker-holiday_undefined", res];
	}
	return [true, newClassName + " datepicker-holiday", res];
}

function check_ja_holiday(date) {
	var y = date.getFullYear();
	var m = date.getMonth() + 1;
	var d = date.getDate();
	var weekday = date.getDay();
	var numweekday = Math.ceil(d / 7);
	if ( m==1 && d==1) {
		return "元日";
	}
	if (y >= 2016) {
		//元日 	1月1日 	年のはじめを祝う。
		// 成人の日 	1月の第2月曜日 おとなになったことを自覚し、みずから生き抜こうとする青年を祝いはげます。
		if (m == 1 && weekday == 1 && numweekday==2) {
			return "成人の日";
		}
		//建国記念の日 	政令で定める日 	建国をしのび、国を愛する心を養う。
		if (m==2) {
			if ( ((y==2017||y==2016) && d==11)
			) {
				return "建国記念の日";
			} else if (y>2017 && d==11) {
				return "？建国記念の日？";
			}
		}

		//春分の日 	春分日 	自然をたたえ、生物をいつくしむ。
		// 3月20日, 2016,2017
		if (m==3) {
			if ( ((y==2017||y==2016) && d==20) ) { return "春分の日"; }
			else if (y>2017 && d==20) { return "？春分の日？"; }
		}

		// 昭和の日 	4月29日 	激動の日々を経て、復興を遂げた昭和の時代を顧み、国の将来に思いをいたす。
		if (m==4 && d==29) {
			return "昭和の日";
		}
		// 憲法記念日 	5月3日 	日本国憲法の施行を記念し、国の成長を期する。
		if (m==5 && d==3) {
			return "昭和の日";
		}
		// みどりの日 	5月4日 	自然に親しむとともにその恩恵に感謝し、豊かな心をはぐくむ。
		if (m==5 && d==4) {
			return "みどりの日";
		}
		// こどもの日 	5月5日 	こどもの人格を重んじ、こどもの幸福をはかるとともに、母に感謝する。
		if (m==5 && d==5) {
			return "こどもの日";
		}
		// 海の日 	7月の第3月曜日 	海の恩恵に感謝するとともに、海洋国日本の繁栄を願う。
		if (m==7 && weekday == 1 && numweekday==3) {
			return "海の日";
		}
		// 山の日 	8月11日 	山に親しむ機会を得て、山の恩恵に感謝する。
		if (m==8 && d==11) {
			return "山の日";
		}
		//敬老の日 	9月の第3月曜日 	多年にわたり社会につくしてきた老人を敬愛し、長寿を祝う。
		if (m==9 && weekday == 1 && numweekday==3) {
			return "敬老の日";
		}
		// 秋分の日 	秋分日 	祖先をうやまい、なくなった人々をしのぶ。
		// 9月23日(2017) 9月22日(2016)
		if (m==9) {
			if ((y==2017 && d==23)
				|| (y==2016 && d==22)
			) {
				return "秋分の日";
			} else if (y>2017 && d==22) {
				return "？秋分の日？";
			}
		}

		// 体育の日 	10月の第2月曜日 	スポーツにしたしみ、健康な心身をつちかう。
		if (m==10 && weekday == 1 && numweekday==2) {
			return "体育の日";
		}
		// 文化の日 	11月3日 	自由と平和を愛し、文化をすすめる。
		if (m==11 && d==3) {
			return "文化の日";
		}
		// 勤労感謝の日 	11月23日 	勤労をたっとび、生産を祝い、国民たがいに感謝しあう。
		if (m==11 && d==23) {
			return "勤労感謝の日";
		}
		// 天皇誕生日 	12月23日 	天皇の誕生日を祝う。
		if (m==12 && d==23) {
			return "天皇誕生日";
		}
	}
	if (y==2015 && m==9 && d==22) { return "休日"; }

	return false;
}