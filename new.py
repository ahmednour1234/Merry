from datetime import datetime, date
from zoneinfo import ZoneInfo  # Python 3.9+

def next_birthday_info(year: int, month: int, day: int,
                       tz: str = "Africa/Cairo",
                       feb29_policy: str = "feb28"):
    """
    year, month, day: تاريخ ميلادك
    tz: التايم زون (افتراضي القاهرة)
    feb29_policy:
        - "feb28": لو الميلاد 29 فبراير وفي سنة مش كبيسة، يعتبره 28 فبراير
        - "mar1":  لو الميلاد 29 فبراير وفي سنة مش كبيسة، يعتبره 1 مارس
    """
    tzinfo = ZoneInfo(tz)
    now = datetime.now(tzinfo)

    def is_leap(y: int) -> bool:
        return (y % 4 == 0) and (y % 100 != 0 or y % 400 == 0)

    def birthday_in_year(y: int) -> date:
        if month == 2 and day == 29 and not is_leap(y):
            return date(y, 2, 28) if feb29_policy.lower() == "feb28" else date(y, 3, 1)
        return date(y, month, day)

    # حدّد عيد ميلاد نفس السنة أو السنة الجاية
    candidate = birthday_in_year(now.year)
    candidate_dt = datetime.combine(candidate, datetime.min.time(), tzinfo)
    next_bday_dt = candidate_dt if candidate_dt >= now else datetime.combine(
        birthday_in_year(now.year + 1), datetime.min.time(), tzinfo
    )

    # العمر الحالي والعمر في عيد الميلاد الجاي
    age_now = now.year - year - ((now.month, now.day) < (month, day))
    age_next = next_bday_dt.year - year

    # المدة الباقية
    delta = next_bday_dt - now
    total_seconds = max(0, int(delta.total_seconds()))
    days = total_seconds // 86400
    hours = (total_seconds % 86400) // 3600
    minutes = (total_seconds % 3600) // 60
    seconds = total_seconds % 60

    return {
        "now": now,
        "next_birthday": next_bday_dt,
        "age_now": age_now,
        "age_at_next_birthday": age_next,
        "remaining": {
            "days": days, "hours": hours, "minutes": minutes, "seconds": seconds
        },
        "is_today": total_seconds == 0
    }

# مثال استخدام:
if __name__ == "__main__":
    info = next_birthday_info(2000, 11, 15)  # عدّل لتاريخ ميلادك (سنة، شهر، يوم)
    if info["is_today"]:
        print("🎉 كل سنة وانت طيب! النهارده عيد ميلادك.")
    else:
        r = info["remaining"]
        print(f"العيد الجاي: {info['next_birthday']:%Y-%m-%d %H:%M} ({info['age_at_next_birthday']} سنة)")
        print(f"الباقي: {r['days']} يوم، {r['hours']} ساعة، {r['minutes']} دقيقة، {r['seconds']} ثانية")
        print(f"عُمرك الآن: {info['age_now']} سنة")

def is_leap_year(year: int) -> bool:
    """تحقق إذا كانت السنة كبيسة."""
    return (year % 4 == 0) and (year % 100 != 0 or year % 400 == 0)
