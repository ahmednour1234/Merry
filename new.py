print("hello world")

name = "ahmed "
print(name)

print("welcome \n to python programming")

age = 20
print(age)

# هنا الخطأ كان في الجمع بين نص وعدد بدون تحويل
print(f"{name}{age}")

number1 = 10
number2 = 3
result = number1 % number2
print(result)

is_raining = False
print(is_raining)

fruits = ["apple", "banana", "cherry"]
print(fruits)

person = {"name": "ahmed", "age": 20}
print(person)

def greet(name):
    return f"Hello, {name}!"
print(greet("ahmed"))

for fruit in fruits:
    print(fruit.capitalize())
if age >= 18:
    print("You are an adult.".capitalize())
else:
    print("You are a minor.")
while age < 25:
    print("You are still young.")
    age += 1
try:
    print(10 / 0)
except ZeroDivisionError:
    print("Cannot divide by zero.")
import math
print(math.sqrt(16))
from datetime import datetime
print(datetime.now())
class Person:
    def __init__(self, name, age):
        self.name = name
        self.age = age
    def introduce(self):
        return f"My name is {self.name} and I am {self.age} years old."
person1 = Person("ahmed", 20)
print(person1.introduce())

with open("example.txt", "w") as file:
    file.write("Hello, world!")
with open("example.txt", "r") as file:
    content = file.read()
    print(content)
import random
print(random.randint(1, 100))

import json
data = {"name": "ahmed", "age": 20}
json_data = json.dumps(data)
print(json_data)
loaded_data = json.loads(json_data)
print(loaded_data)
match age:
    case 18:
        print("Just became an adult.")
    case 20:
        print("In your twenties.")
    case _:
        print("Age is just a number.")
import requests
response = requests.get("https://api.github.com")
print(response.status_code)
print(response.json())
import asyncio
async def main():
    print("Hello ...")
    await asyncio.sleep(1)
    print("... World!")
