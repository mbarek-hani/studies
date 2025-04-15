import inspect

class Test:
    def __init__(self):
        self.__passed = 0
        self.__failed = 0
    
    @property
    def passed(self):
        return self.__passed
    
    @property
    def failed(self):
        return self.__failed
    
    def assert_eq(self, value, expected):
        try:
            assert value == expected, f"Expected {expected}, got {value}."
            self.__passed += 1
        except AssertionError as e:
            print(f"\033[91m[-]Test in line {inspect.currentframe().f_back.f_lineno} failed\033[00m:", e)
            self.__failed += 1
    
    def assert_neq(self, value, expected):
            try:
                assert value != expected, f"Expected {expected} to be different from {value}."
                self.__passed += 1
            except AssertionError as e:
                print(f"\033[91m[-]Test in line {inspect.currentframe().f_back.f_lineno} failed\033[00m:", e)
                self.__failed += 1
    
    def assert_raises(self, callable, exception):
        try:
            callable()
            print(f"\033[91m[-]Test in line {inspect.currentframe().f_back.f_lineno} failed\033[00m: Exception {exception} was not raised.")
            self.__failed += 1
        except exception:
            self.__passed += 1
        except Exception as e:
            print(f"\033[91m[-]Test in line {inspect.currentframe().f_back.f_lineno} failed\033[00m: Expected exception {exception}, got {e.__class__.__name__}.")
            self.__failed += 1
        
    
    def __del__(self):
        print(f"=============\033[92mTests passed: {self.passed}\033[00m, \033[91mtests failed: {self.failed}\033[00m=============")
